<?php namespace App\Services;

use App\Library\utils;
use App\Models\AcademicYearModel;
use App\Models\ConvoModel;
use App\Models\HeiModel;
use App\Models\ProgramModel;
use App\Repositories\convoRepository;
use App\Repositories\derivedRepository;
use App\Repositories\searchRepository;
use App\WitApp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class convoService
{

    /**
     * @var convoRepository
     */
    public $oConvoRepository;

    /**
     * @var derivedRepository
     */
    private $oDerivedRepository;

    /**
     * @var searchRepository
     */
    private $oSearchRepository;

    /**
     * convoService constructor.
     * @param convoRepository $oConvoRepository
     * @param derivedRepository $oDerivedRepository
     * @param searchRepository $oSearchRepository
     */
    public function __construct(convoRepository $oConvoRepository, derivedRepository $oDerivedRepository, searchRepository $oSearchRepository)
    {
        $this->oConvoRepository = $oConvoRepository;
        $this->oDerivedRepository = $oDerivedRepository;
        $this->oSearchRepository = $oSearchRepository;
    }

    /**
     * Getting convo per login
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getConvoPerLogin()
    {
        return $this->oDerivedRepository->getConvoPerLogin();
    }

    /**
     * Replying in convo
     * @param string $sContent
     * @return array|bool
     */
    public function reply(string $sContent)
    {
        \preg_match_all('/{{[a-z0-9\s]+}}/i', $sContent, $mPrograms);
        $oWit = new WitApp();
        $aConvo = [];
        if (strlen($sContent) <= 5) {
            return [
                'code' => 502,
                'error' => 'Minimum text command written. Please try again.'
            ];
        }
        $aContent = $oWit->getIntentByText($sContent);
        if (count($aContent['intents']) <= 0 && count($aContent['entities']) > 0) {
            $aContent['intents'] = [
                'name' => 'getHei'
            ];
        }
        if (isset($aContent['error']) === true && $aContent['error'] === true) {
            return [
                'code' => 500,
                'error' => 'Something went wrong. Please try again.'
            ];
        }
        if ($aContent['text'] === null || $aContent['intents'] === [] || (\count($mPrograms[0]) <= 0 && ($aContent['entities'] === null && @$aContent['entities'] === []))) {
            return [
                'code' => 501,
                'error' => 'Please check your command. Please try again.'
            ];
        }
        $aConvo['user_id'] = 1;
        $aConvo['message'] = $this->analyzeConvo($aContent);
        $aConvo['reply_user_id'] = Auth::id();
        $aConvo['created_at'] = Carbon::now();
        $aConvo['deleted'] = null;
        if (\array_search(self::getIntent($aContent), ['getCountHei', 'getCountSuc', 'getCountLuc', 'getCountPheis']) === false) {
            $aConvo['url'] = self::parseUrl($aContent);
        }
        return $aConvo;
    }

    /**
     * Analyze the convo
     * @param $aContent
     * @return string
     */
    private function analyzeConvo($aContent)
    {
        if (\array_search(self::getIntent($aContent), ['getCountHei', 'getCountSuc', 'getCountLuc', 'getCountPheis']) !== false) {
            $mCountHei = \call_user_func([$this->oDerivedRepository, self::getIntent($aContent)]);
            return 'Hello! ' . Auth::user()->name . ', as of ' . Carbon::now()->format('l M d, Y') . ' there are <span class="font-extrabold text-gray-900 text-lg">' .
                $mCountHei['count'] . ' of ' . $mCountHei['type'] . '</span> in our record!';
        }
        $aExtract = self::extractEntities($aContent);
        return 'Hello! ' . Auth::user()->name . ', this is the report for you, you can click this to view full report<br/><strong>' . $this->generateTitle($aExtract['year'], $aExtract['type'], $aExtract['course'])[self::getIntent($aContent)] . '</strong>';
    }

    /**
     * Generating url based from response in WIT
     * @param array $aContent
     * @return string
     */
    private static function parseUrl(array $aContent)
    {
        $aExtract = self::extractEntities($aContent);
        return '?intent=' . self::getIntent($aContent) . '&by=' . $aExtract['group'] . '&year=' . $aExtract['year'] . '&type=' . $aExtract['type'] . '&courses=' . $aExtract['course'];
    }

    private static function extractEntities($aContent) {
        \preg_match('/' . implode('|', AcademicYearModel::all()->pluck('year')->toArray() ?? []) . '/', $aContent['text'], $mYear);
        \preg_match_all('/{{[a-z0-9\s]+}}/i', $aContent['text'], $mPrograms);
        $mFromEntityPrograms = \array_filter(array_keys($aContent['entities']), function($sEntity) {
            return preg_match('/^_\w+/', explode(':', $sEntity)[0]);
        });
        $mPrograms = array_merge($mFromEntityPrograms, $mPrograms[0]);
        $sGroupby = preg_replace('/by |and /', ',', \implode(\array_column(@$aContent['entities']['groupBy'] ?? [], 'value')));
        $sType = @$aContent['entities']['getType:getType'][0]['value'];
        $sCourse = \preg_replace('/{{|}}/', ' ', \implode(', ', $mPrograms));
        $sCourse = utils::convertEntityName($sCourse, true);
        $mYear = @$mYear[0];
        return [
            'year'   => $mYear,
            'type'   => $sType,
            'course' => $sCourse,
            'group'  => $sGroupby
        ];
    }

    /**
     * getting Intent
     * @param array $aContent
     * @return string
     */
    private static function getIntent(array $aContent)
    {
        $sIntent = \implode('', \array_column(@$aContent['intents'] ?? [], 'name'));
        return  ($sIntent !== '') ? $sIntent : 'getHei';
    }

    /**
     * @param string $sIntent
     * @param $mBy
     * @param $mType
     * @param $mYear
     * @param $mCourses
     * @return array
     */
    public function analyzeReportData(string $sIntent, $mBy, $mType, $mYear, $mCourses)
    {
        $aIntent = [
            'getHei' => '1',
            'getSuc' => 'hei.type like "%suc%"',
            'getLuc' => 'hei.type like "%local%" or hei.type like "%luc%"',
            'getPheis' => 'hei.type not like "%suc%" and  hei.type not like "%local%" and hei.type not like "%luc%"'
        ];
        return $this->oConvoRepository->getDataByInstitution(($sIntent === 'getType') ? true : $aIntent[$sIntent], \ucwords($mType), $mYear, $mCourses);
    }

    /**
     * @param $sValue
     * @param $iLength
     * @return mixed
     */
    public function searchProgram($sValue) {
        return $this->oSearchRepository->searchProgram($sValue);
    }

    /**
     * @return array
     */
    public function getReport()
    {
        $sIntent = \request()->get('intent') ?? 'getHei';
        $mBy = \request()->get('by');
        $mType = \request()->get('type');
        $mYear = \request()->get('year');
        $mCourses = \request()->get('courses');

        return [
            'data_source' => $this->analyzeReportData($sIntent, $mBy, $mType, $mYear, $mCourses),
            'chart' => \request()->get('chart') ?? 'bar',
            'title' => $this->generateTitle($mYear, $mType, $mCourses)[$sIntent],
            'intent' => $sIntent
        ];
    }

    /**
     * @param $mYear
     * @param $mType
     * @param $mCourses
     * @return array
     */
    private function generateTitle($mYear, $mType, $mCourses) {
        $mInCourse = ($mCourses === null || \strlen($mCourses) <= 0) ? '' : ' (' . $mCourses . ' )';
        $mInYear = ($mYear === null || \strlen($mYear) <= 0) ? '' : ' in ' . $mYear;
        $mUsingType = (($mType === null || \strlen($mType) <= 0) ? '' : ' using ' . \ucfirst($mType) . ' Data') . $mInYear;
        return [
            'getHei' => 'Summary of Higher Education Institution (HEI)' . $mUsingType . $mInCourse,
            'getSuc' => 'Summary of State University and College (SUC)' . $mUsingType . $mInCourse,
            'getLuc' => 'Summary of Local University and College (LUC)' . $mUsingType . $mInCourse,
            'getPheis' => 'Summary of Private Higher Education Institution (PHEI)' . $mUsingType . $mInCourse,
            'getType' => \ucfirst($mType) . ' Data' . $mInYear . $mInCourse
        ];

    }
}
