<?php

namespace App;

use Carbon\Carbon;
use Jeylabs\Wit\Wit as BaseWit;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class WitApp extends BaseWit
{
    const WIT_API_VERSION = '20211130';
    const DEFAULT_TIMEOUT = '10000';
    const ACCESS_TOKEN = 'CBNSVLGCAIF2HPBKJ46FMRFD4JBREKV2';
    const ASYNC_REQUEST = false;

    public function __construct()
    {
        parent::__construct(self::ACCESS_TOKEN, self::ASYNC_REQUEST);
    }

    protected function getDefaultHeaders()
    {
        $aDefaultHeaders = parent::getDefaultHeaders();
        $aDefaultHeaders['Accept'] = 'application/json';
        return $aDefaultHeaders;
    }

    public function getUtterances(int $iOffset = 0, int $iLimit = 10, string $sIntent = 'all')
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

    public function getEntities()
    {
        try {
            return parent::getEntities();
        } catch (\Exception $oException) {
            return [
                'error' => true,
                'message' => $oException->getMessage()
            ];
        }
    }

    public function trainApp(array $aData)
    {
        try {
            return $this->makeRequest('POST', 'utterances', [], $aData);
        } catch (\Exception $oException) {
            return [
                'error' => true,
                'message' => $oException->getMessage()
            ];
        }
    }

    public function removeEntity($sData)
    {
        try {
            return $this->makeRequest('DELETE', 'entities/' . $sData, []);
        } catch (\Exception $oException) {
            return [
                'error' => true,
                'message' => $oException->getMessage()
            ];
        }
    }
}
