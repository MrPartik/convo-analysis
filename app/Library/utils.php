<?php

namespace App\Library;

class utils
{
    public static function getNAForNull($sVal) {
        return (@$sVal === null || @$sVal === '' || \strlen(@$sVal) === 0 || @$sVal === '-') ? 'N/A' : $sVal;
    }
}
