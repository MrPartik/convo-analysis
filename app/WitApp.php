<?php

namespace App;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Jeylabs\Wit\Wit as BaseWit;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class WitApp extends BaseWit
{
    const WIT_API_VERSION = '20190715';
    const DEFAULT_TIMEOUT = '10000';
    const ACCESS_TOKEN = 'JKPY6E2VOPCI52RP4CBEXLFEEMKH5I7Y';
    const ASYNC_REQUEST = false;

    public function __construct()
    {
        parent::__construct(self::ACCESS_TOKEN, self::ASYNC_REQUEST);
    }

    public function getUtterances(int $iOffset = 100, int $iLimit = 500, string $sIntent = 'all')
    {
        try {
            return $this->makeRequest('GET', 'utterances', 'limit=' . $iLimit . '&' . 'offset=' . $iOffset . (($sIntent === 'all') ? '' : '&intents=' . $sIntent) );
        } catch (\Exception $oException) {
            return [];
        }
    }

    public function getIntents()
    {
        try {
            return $this->makeRequest('GET', 'intents');
        } catch (\Exception $oException) {
            return [];
        }
    }

    public function getIntentByText($sQuery, $aParams = [])
    {
        try {
            return parent::getIntentByText($sQuery, $aParams);
        } catch (\Exception $oException) {
            return [
                'error' => true,
                'message' => $oException->getMessage()
            ];
        }
    }
}
