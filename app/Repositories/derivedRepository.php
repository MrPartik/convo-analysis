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
            ->join('r_hei as hei', 'program.code', '=', 'hei.code')
            ->select('hei.city', DB::raw('count(hei.city) total'))
            ->groupBy('hei.city')
            ->limit(5)
            ->get();
    }

    /**
     * Get Hei
     * @return mixed
     */
    public static function getHei()
    {
        return HeiModel::all();
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


    public static function getProgramReportData($sType, $bIsEnrollment, $iOffset = 0, $iLimit = 10)
    {
        $oDbResult = collect(DB::select('select distinct hdc.year year, hd.hei_code  hei_code, count(hdc.id) hei_count
            from r_hei_data hd
            inner join r_hei_data_count hdc on hdc.hei_data_id = hd.id
            inner join r_hei h on h.code = hd.hei_code
            where h.type = ? and hd.type = ?
            group by hdc.year, hd.hei_code, hd.type, hdc.semester', [$sType, ($bIsEnrollment === true) ? 'enrollment' : 'graduate']));
        $aResult = [];
        foreach ($oDbResult as $mKey => $mVal) {
            if (isset($aResult[$mVal->year]) === false) {
                $aResult[$mVal->year] = [
                    'year' => $mVal->year,
                    'total_hei' => $mVal->hei_count
                ];
            } else {
                $aResult[$mVal->year]['total_hei'] += $mVal->hei_count;
            }
        }
        return $aResult;
    }

    public static function getCountHei()
    {
        return [
            'type' => 'HEI',
            'count' => self::getHei()->count()
        ];
    }

    public static function getCountSuc()
    {
        return [
            'type' => 'SUC',
            'count' => self::getSuc()->count()
        ];
    }

    public static function getCountLuc()
    {
        return [
            'type' => 'LUC',
            'count' => self::getLuc()->count()
        ];
    }

    public static function getCountPheis()
    {
        return [
            'type' => 'PHEIS',
            'count' => self::getPheis()->count()
        ];
    }

}
