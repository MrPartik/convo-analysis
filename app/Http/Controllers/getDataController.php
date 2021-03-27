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
        return DB::select("select hdc.year year, hei.region region, hei.hei_name hei, progc.title category, prog.program program, concat(ucase(substring(hd.type, 1, 1)), lower(substring(hd.type, 2))) type, hdc.m as male, hdc.f female, sum(hdc.m + hdc.f) total from r_hei_data_count hdc join r_hei_data hd on hdc.hei_data_id = hd.id join r_program prog on hd.program_id = prog.id join r_hei hei on prog.code = hei.code join r_program_categories progc on progc.id = prog.program_category_id where 1 and 1 and prog.program in ('" . request()->get('sql') . "') and 1 group by hdc.year, hei.region, prog.program, hd.type, hdc.m, hdc.f");
    }

    public function get()
    {
        return $this->oConvoService->getReport();
    }
}
