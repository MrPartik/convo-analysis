<?php namespace App\Repositories;

use App\Models\AcademicYearModel;
use App\Models\ConvoModel;
use App\Models\HeiModel;
use App\Models\ProgramModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class derivedRepository
{

    private $oHeiModel;
    private $oProgramModel;
    private $oConvoModel;


    /**
     * derivedRepository constructor.
     */
    public function __construct()
    {
        $this->oHeiModel = new HeiModel();
        $this->oProgramModel = new ProgramModel();
        $this->oConvoModel = new ConvoModel();
    }

    /**
     * Getting convo per login
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getConvoPerLogin()
    {
        return $this->oConvoModel::with(['repliedUser', 'messageUser'])
            ->where('user_id', Auth::id())
            ->orWhere('reply_user_id', '=', Auth::id())
            ->orWhere('reply_user_id', '=' , 0)
            ->get()
            ->whereNull('deleted');
    }

    /**
     * Get program by city
     * @return Collection
     */
    public function programByCity()
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
    public function getHei()
    {
        return $this->oHeiModel::all();
    }

    /**
     * Get Suc
     * @return mixed
     */
    public function getSuc()
    {
        return $this->oHeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'like', '%suc%')
                ->orWhere('type', 'like', '%state university%')
                ->get();
        });
    }

    /**
     * Get Luc
     * @return mixed
     */
    public function getLuc()
    {
        return $this->oHeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'like', '%luc%')
                ->orWhere('type', 'like', '%local%')
                ->get();
        });
    }

    /**
     * Get Pheis
     * @return mixed
     */
    public function getPheis()
    {
        return $this->oHeiModel::where(function ($oQuery) {
            return $oQuery->orWhere('type', 'like', '%pheis%')
                ->orWhere('type', 'like', '%private%')
                ->get();
        });
    }

    /**
     * Get unique program
     * @return ProgramModel[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProgram()
    {
        return $this->oProgramModel::all()->unique('program');
    }


    /**
     * Getting program report by data
     * @param $sType
     * @param $bIsEnrollment
     * @param int $iOffset
     * @param int $iLimit
     * @return array
     */
    public function getProgramReportData($sType, $bIsEnrollment, $iOffset = 0, $iLimit = 10)
    {
        $oDbResult = collect(DB::select('select distinct hdc.year year, hd.hei_code  hei_code, count(hdc.id) hei_count
            from r_hei_data hd
            inner join r_hei_data_count hdc on hdc.hei_data_id = hd.id
            inner join r_hei h on h.code = hd.hei_code
            where ' . (($sType !== 'ALL') ? 'h.type ="' . $sType . '"' : true ) . ' and hd.type = ?
            group by hdc.year, hd.hei_code, hd.type, hdc.semester', [($bIsEnrollment === true) ? 'enrollment' : 'graduate']));
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


    public function getDataPerAcademicYear($iYear, $bIsEnrollment)
    {
        $oDbResult = collect(DB::select('select distinct hdc.year year, h.type  hei_type, h.region region, sum(hdc.m + hdc.f) hei_count
            from r_hei_data hd
            inner join r_hei_data_count hdc on hdc.hei_data_id = hd.id
            inner join r_hei h on h.code = hd.hei_code
            where  hd.type = ? and hdc.year = ?
            group by hdc.year, h.type', [($bIsEnrollment === true) ? 'enrollment' : 'graduate', $iYear]));
        $aHEIsResult = [];
        $aHEIsKeys = [
            'All',
            'SUC',
            'LUC',
            'Private'
        ];
        foreach($aHEIsKeys as $mKey) {
            foreach ($oDbResult as $mValue) {
                if($mKey !== 'All')
                {
                    if($mKey === 'SUC' && \preg_match('/SUC/', $mValue->hei_type) !== -1) {
                        @$aHEIsResult[$mKey] += $mValue->hei_count;
                        continue;
                    } else if(($mKey === 'LUC' && \preg_match('/LUC/', $mValue->hei_type)) || 'LGU' === strtoupper($mValue->hei_type)) {
                        @$aHEIsResult[$mKey] += $mValue->hei_count;
                        continue;
                    } else if($mKey === 'Private' && \preg_match('/Private/', $mValue->hei_type)) {
                        @$aHEIsResult[$mKey] += $mValue->hei_count;
                    }
                }
            }
            ($mKey !== 'All') && @$aHEIsResult['All'] += $aHEIsResult[$mKey];
        }
        $aRegionResult = [];
        foreach ($oDbResult->unique('region') as $mKey) {
            foreach ($oDbResult as $mValue) {
                ($mKey->region === $mValue->region) && @$aRegionResult[$mKey->region] += $mValue->hei_count;
            }
        }
        return [
            'hei'    => $aHEIsResult,
            'region' => $aRegionResult
        ];
    }

    /**
     * getting cunt by hei
     * @return array
     */
    public function getCountHei()
    {
        return [
            'type' => 'HEI',
            'count' => $this->getHei()->count()
        ];
    }

    /**
     * getting count by suc
     * @return array
     */
    public function getCountSuc()
    {
        return [
            'type' => 'SUC',
            'count' => $this->getSuc()->count()
        ];
    }

    /**
     * getting count by luc
     * @return array
     */
    public function getCountLuc()
    {
        return [
            'type' => 'LUC',
            'count' => $this->getLuc()->count()
        ];
    }

    /**
     * getting count by pheis
     * @return array
     */
    public function getCountPheis()
    {
        return [
            'type' => 'PHEIS',
            'count' => $this->getPheis()->count()
        ];
    }

    public function getAcademicYear()
    {
        $aResult = [];
        $aYears = AcademicYearModel::all()->toArray();
        for($i = 0; $i < \count($aYears); $i++) {
            $aResult[$aYears[$i]['year']] = $aYears[$i]['year'] . '-' . (($i === \count($aYears) - 1) ? (($aYears[$i]['year']) + 1) :  $aYears[$i + 1]['year']);
        }
        return $aResult;
    }
}
