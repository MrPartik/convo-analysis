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
    const DEFAULT_TIMEOUT = '1000';
    const ACCESS_TOKEN = 'JKPY6E2VOPCI52RP4CBEXLFEEMKH5I7Y';
    const ASYNC_REQUEST = false;
    const HTTP_CLIENT = null;

    public function __construct()
    {
        parent::__construct(self::ACCESS_TOKEN, self::ASYNC_REQUEST, self::HTTP_CLIENT);
    }

    public function getIntentByText($sQuery, $aParams = [])
    {
        try {
            return parent::getIntentByText($sQuery, $aParams);
        } catch (GuzzleException $oException) {
            return [];
        }
    }
}
