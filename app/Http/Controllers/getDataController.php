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
       return DB::select('SELECT hdc.year year, hei.region region, HEI.HEI_NAME hei, progc.title category, PROG.program program, count(hdc.YEAR) total
                                from r_hei_data_count hdc
                                join r_hei_data hd on hdc.hei_data_id = hd.id
                                join r_program prog on hd.program_id = prog.id
                                join r_hei hei on prog.code = hei.code
                                join r_program_categories progc on progc.id = prog.program_category_id
                                GROUP BY hdc.YEAR, hei.region, prog.program'
       );
    }
}
