<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class getDataController extends Controller
{
    public function get()
    {
        return DB::select(\request()->get('sql'));
    }
}
