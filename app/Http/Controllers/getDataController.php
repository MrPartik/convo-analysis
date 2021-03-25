<?php

namespace App\Http\Controllers;

use App\Services\convoService;
use Illuminate\Support\Facades\DB;

class getDataController extends Controller
{

    public $oConvoService;

    public function __construct(convoService $oConvoService)
    {
        $this->oConvoService = $oConvoService;
    }

    public function debug()
    {
        return DB::select(\request()->get('sql'));
    }

    public function get()
    {
        $sIntent = \request()->get('intent') ?? 'getSuc';
        $mBy = \request()->get('by');
        $mType = \request()->get('type');
        $mYear = \request()->get('year');
        $mInYear = ($mYear === null || \strlen($mYear) <= 0) ? '' : ' in ' . $mYear;
        $mUsingType = (($mType === null || \strlen($mType) <= 0) ? '' : ' using ' . \ucfirst($mType) . ' Data') . $mInYear;
        $aByTitle = [
            'getHei'   => 'Summary of Higher Education Institution (HEI)' . $mUsingType ,
            'getSuc'   => 'Summary of State University and College (SUC)' . $mUsingType ,
            'getLuc'   => 'Summary of Local University and College (LUC)' . $mUsingType ,
            'getPheis' => 'Summary of Private Higher Education Institution (PHEI)' . $mUsingType ,
            'getType'  => \ucfirst($mType) .  ' Data' . $mInYear
        ];
        return [
            'data_source' =>  $this->oConvoService->analyzeReportData($sIntent, $mBy, $mType, $mYear),
            'chart'       => \request()->get('chart') ?? 'bar',
            'title'       => $aByTitle[$sIntent],
            'intent'      => $sIntent
        ];
    }
}
