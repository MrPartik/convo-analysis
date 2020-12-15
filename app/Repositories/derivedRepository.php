<?php namespace App\Repositories;

use App\Models\HeiModel;
use App\Models\ProgramModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class derivedRepository
{
    /**
     * Get program by city
     * @return Collection
     */
    public static function programByCity()
    {
        return DB::table('R_PROGRAM', 'PROGRAM')
            ->join('R_HEI AS HEI' ,'PROGRAM.CODE', '=', 'HEI.CODE')
            ->select('HEI.CITY', DB::raw('COUNT(HEI.CITY) TOTAL'))
            ->groupBy('HEI.CITY')
            ->limit(5)
            ->get();
    }

    /**
     * Get Suc
     * @return mixed
     */
    public static function getSuc()
    {
        return HeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'LIKE', '%suc%')
                ->orWhere('type', 'LIKE', '%state university%');
        });
    }

    /**
     * Get Luc
     * @return mixed
     */
    public static function getLuc()
    {
        return HeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'LIKE', '%luc%')
                ->orWhere('type', 'LIKE', '%local%');
        });
    }

    /**
     * Get Pheis
     * @return mixed
     */
    public static function getPheis()
    {
        return HeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'LIKE', '%pheis%')
                ->orWhere('type', 'LIKE', '%private%');
        });
    }

    /**
     * Get unique program
     * @return ProgramModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getProgram()
    {
        return ProgramModel::all()->unique('program');
    }

}
