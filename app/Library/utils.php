<?php

namespace App\Library;

class utils
{
    /**
     * @param $sVal
     * @return string
     */
    public static function getNAForNull($sVal)
    {
        return (@$sVal === null || @$sVal === '' || \strlen(@$sVal) === 0 || @$sVal === '-') ? 'N/A' : $sVal;
    }

    /**
     * @param $aValue
     * @return array|string
     */
    public static function getStringedArray($aValue)
    {
        $aNewValue = [];
        foreach ($aValue as $sValue) {
            $aNewValue[] = "'" . $sValue . "'";
        }
        return $aNewValue;
    }

    public static function convertEntityName(string $sValue, bool $bIsFromFormatted = false)
    {
        $sValue = explode(':', $sValue)[0];
        $aStringReplace = [
            '.' => '--_--',
            '/' => '_-__-_',
            '(' => '_-__-',
            ')' => '-__-_',
            '&' => '--_-_--',
            ' ' => '_'
        ];
        if ($bIsFromFormatted === false)
        {
            $sValue = '_' . trim($sValue) . '_';
            foreach ($aStringReplace as $sSymbol => $sPattern) {
                $sValue = str_replace($sSymbol, $sPattern, $sValue);
            }
            return $sValue;
        }
        foreach ($aStringReplace as $sSymbol => $sPattern) {
            $sValue = str_replace($sPattern, $sSymbol, $sValue);
        }
        return trim($sValue);

    }
}
