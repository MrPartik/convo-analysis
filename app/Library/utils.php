<?php

namespace App\Library;

class utils
{
    /**
     * @param $sVal
     * @return string
     */
    public static function getNAForNull($sVal) {
        return (@$sVal === null || @$sVal === '' || \strlen(@$sVal) === 0 || @$sVal === '-') ? 'N/A' : $sVal;
    }

    /**
     * @param $aValue
     * @return array|string
     */
    public static function getStringedArray($aValue) {
        $aNewValue = [];
        foreach($aValue as $sValue) {
            $aNewValue[] = "'" . $sValue . "'";
        }
        return $aNewValue;
    }
}
