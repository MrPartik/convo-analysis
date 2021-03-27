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
        return $this->oConvoService->getReport();
    }
}
