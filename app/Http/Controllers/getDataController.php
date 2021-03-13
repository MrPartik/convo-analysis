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
        $sIntent = \request()->get('intent') ?? 'getHei';
        $sBy = \request()->get('by');
        $aByTitle = [
            'getHei'   => 'Summary of Higher Education Institution (HEI)',
            'getSuc'   => 'Summary of State University and College (SUC)',
            'getLuc'   => 'Summary of Local University and College (LUC) ',
            'getPheis' => 'Summary of Private Higher Education Institution (PHEI)'
        ];
        return [
            'data_source' =>  $this->oConvoService->analyzeReportData($sIntent, $sBy),
            'chart'       => \request()->get('chart') ?? 'bar',
            'title'       => $aByTitle[$sIntent]
        ];
    }
}
