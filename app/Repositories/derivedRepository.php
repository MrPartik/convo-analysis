<?php namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class derivedRepository
{
    public static function programByCity()
    {
        return DB::table('R_PROGRAM', 'PROGRAM')
            ->join('R_HEI AS HEI' ,'PROGRAM.CODE', '=', 'HEI.CODE')
            ->select('HEI.CITY', DB::raw('COUNT(HEI.CITY) TOTAL'))
            ->groupBy('HEI.CITY')
            ->limit(5)
            ->get();
    }

}
