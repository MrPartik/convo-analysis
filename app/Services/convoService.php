<?php namespace App\Services;

use App\Repositories\convoRepository;
use App\Repositories\derivedRepository;
use App\WitApp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\matches;

class convoService
{

    public $oConvoRepository;

    public function __construct()
    {
        $this->oConvoRepository = new convoRepository();
    }

    /**
     * Replying in convo
     * @param string $sContent
     * @return array|bool
     */
    public function reply(string $sContent)
    {
        $oWit = new WitApp();
        $aConvo = [];
        $aContent = $oWit->getIntentByText($sContent);
        if (@$aContent['entities'] === null || @$aContent['entities'] === [] || (isset($aContent['error']) === true && $aContent['error'] === true)) {
            return false;
        }
        $aConvo['user_id'] = 1;
        $aConvo['message'] = self::analyzeConvo($aContent);
        $aConvo['reply_user_id'] = Auth::id();
        $aConvo['created_at'] = Carbon::now();
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
    private static function analyzeConvo($aContent)
    {
        if (\array_search(self::getIntent($aContent), ['getCountHei', 'getCountSuc', 'getCountLuc', 'getCountPheis']) !== false) {
            $mCountHei = call_user_func(derivedRepository::class . '::' . self::getIntent($aContent));
            return 'Hello! ' . Auth::user()->name . ', as of ' . Carbon::now()->format('l M d, Y') . ' there are <span class="font-extrabold text-gray-900 text-lg">' .
                $mCountHei['count'] . ' of ' . $mCountHei['type'] . '</span> in our record!';
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
        \preg_match('/2017|2018|2019|2020/', $aContent['_text'], $mYear);
        return '?intent=' . self::getIntent($aContent) . '&by=' . $sGroupby . '&year=' . \collect($mYear)->first() . '&type=' . @$aContent['entities']['getType'][0]['value'];
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


    public function analyzeReportData(string $sIntent, $mBy, $mType, $mYear)
    {
        $aIntent = [
            'getHei' => '1',
            'getSuc' => 'hei.type like "%suc%"',
            'getLuc' => 'hei.type like "%local%" or hei.type like "%luc%"',
            'getPheis' => 'hei.type not like "%suc%" and  hei.type not like "%local%" and hei.type not like "%luc%"'
        ];
        return $this->oConvoRepository->getDataByInstitution(($sIntent === 'getType') ? true : $aIntent[$sIntent], \ucwords($mType), $mYear);
    }
}
