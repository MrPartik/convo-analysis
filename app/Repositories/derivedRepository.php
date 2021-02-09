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
        return DB::table('r_program', 'program')
            ->join('r_hei as hei' ,'program.code', '=', 'hei.code')
            ->select('hei.city', DB::raw('count(hei.city) total'))
            ->groupBy('hei.city')
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
            return $oQuery->orWhere('type', 'like', '%suc%')
                ->orWhere('type', 'like', '%state university%')
                ->get();
        });
    }

    /**
     * Get Luc
     * @return mixed
     */
    public static function getLuc()
    {
        return HeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'like', '%luc%')
                ->orWhere('type', 'like', '%local%')
                ->get();
        });
    }

    /**
     * Get Pheis
     * @return mixed
     */
    public static function getPheis()
    {
        return HeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'like', '%pheis%')
                ->orWhere('type', 'like', '%private%')
                ->get();
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


    public static function  getProgramReportData($sType, $bIsEnrollment, $iOffset = 0, $iLimit = 10)
    {
        return DB::table('r_hei_data_count as hdc')
            ->join('r_hei_data as hd', 'hdc.hei_data_id', '=', 'hd.id')
            ->join('r_program as p', 'hd.program_id', '=',  'p.id')
            ->join('r_hei as h', 'h.code', '=', 'p.code')
            ->join('r_program_categories as pc', 'pc.id', '=', 'p.program_category_id')
            ->where('h.type', '=', $sType)
            ->where('hd.type', '=', ($bIsEnrollment === true) ? 'enrollment' : 'graduate')
            ->groupBy('hdc.year', 'h.region', 'p.program')
            ->select(['hdc.year as year', 'h.region as region', 'h.hei_name as hei', 'pc.title as category', 'p.program as program, count(hdc.year) as total'])
            ->get();
    }

}
