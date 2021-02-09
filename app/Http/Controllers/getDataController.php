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
       return DB::select('select hdc.year year, hei.region region, hei.hei_name hei, progc.title category, prog.program program, count(hdc.year) total from r_hei_data_count hdc join r_hei_data hd on hdc.hei_data_id = hd.id join r_program prog on hd.program_id = prog.id join r_hei hei on prog.code = hei.code join r_program_categories progc on progc.id = prog.program_category_id group by hdc.year, hei.region, prog.program');
    }
}
