<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class getDataController extends Controller
{
    public function debug()
    {
        return DB::select(\request()->get('sql'));
    }

    public function get()
    {
        return [
            'data_source' =>  $this->generateDataSource(\request()->get('intent'), \request()->get('by')),
            'chart'       => \request()->get('chart') ?? 'bar'
        ];
    }

    private function generateDataSource($sIntent, $sBy)
    {
       return DB::select('SELECT PROGRAM id, HEI.region category, CITY sub_category, HEI.yr_established year , COUNT(*)  total FROM R_PROGRAM AS PROGRAM INNER JOIN R_HEI AS HEI ON PROGRAM.code = HEI.code GROUP BY city');
    }
}
