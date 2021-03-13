<?php namespace App\Services;

use App\Repositories\convoRepository;
use App\Repositories\derivedRepository;
use App\WitApp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class convoService
{

    public $oConvoRepository;

    public function __construct()
    {
        $this->oConvoRepository = new convoRepository();
    }

    /**
     * Replying in convo
     * @param string $aContent
     * @return array|bool
     */
    public function reply(string $aContent)
    {
        $oWit = new WitApp();
        $aConvo = [];
        $aContent = $oWit->getIntentByText($aContent);
        $aConvo['user_id'] = 1;
        $aConvo['message'] = self::analyzeConvo($aContent);
        $aConvo['reply_user_id'] = Auth::id();
        $aConvo['created_at'] = Carbon::now();
        if (\array_search(self::getIntent($aContent), ['getCountHei', 'getCountSuc', 'getCountLuc', 'getCountPheis']) === false) {
            $aConvo['url'] = self::parseUrl($aContent);
        }
        if (@$aContent['entities'] === null || @$aContent['entities'] === [] || (isset($aContent['error']) === true && $aContent['error'] === true)) {
            return false;
        }
        return $aConvo;
    }

    /**
     * Analyze the convo
     * @param $aContent
     * @return string
     */
    private static function analyzeConvo($aContent)
    {
        if (\array_search(self::getIntent($aContent), ['getCountHei', 'getCountSuc', 'getCountLuc', 'getCountPheis']) !== false) {
            $mCoutHei = call_user_func(derivedRepository::class . '::' . self::getIntent($aContent));
            return 'Hello! ' . Auth::user()->name . ', as of ' . Carbon::now()->format('l M d, Y') . ' there are <span class="font-extrabold text-gray-900 text-lg">' .
                $mCoutHei['count'] . ' of ' . $mCoutHei['type'] . '</span> in our record!';
        }
        return 'Hello! ' . Auth::user()->name . ', this is the report for you, you can click this to view full report';
    }

    /**
     * Generating url based from response in WIT
     * @param array $aContent
     * @return string
     */
    private static function parseUrl(array $aContent)
    {
        $sGroupby = preg_replace('/by |and /', ',', \implode(\array_column(@$aContent['entities']['groupBy'] ?? [], 'value')));
        return '?intent=' . self::getIntent($aContent) . '&by=' . $sGroupby;
    }

    /**
     * getting Intent
     * @param array $aContent
     * @return string
     */
    private static function getIntent(array $aContent)
    {
        return \implode('', \array_column(@$aContent['entities']['intent'] ?? [], 'value'));
    }


    public function analyzeReportData(string $sIntent, $mBy)
    {
        $aIntent = [
            'getHei' => '1',
            'getSuc' => 'hei.type like "%suc%"',
            'getLuc' => 'hei.type like "%local%" or hei.type like "%luc%"',
            'getPheis' => 'hei.type like "%pheis%" or hei.type like "%private%"'
        ];
        $getStudentDataType = (strlen($mBy) <= 0 || $mBy === null || (\preg_match('/enroll/i', $mBy) === 0 && \preg_match('/graduate/i', $mBy) === 0)) ? null : ((strlen($mBy) > 0 && \preg_match('/enroll/i', $mBy)) ? 'ENROLLMENT' : 'GRADUATE');
        return $this->oConvoRepository->getDataByInstitution($aIntent[$sIntent], $mBy, $getStudentDataType);
    }
}
