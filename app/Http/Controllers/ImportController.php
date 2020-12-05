<?php

namespace App\Http\Controllers;

use App\Imports\ImportHei;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function front()
    {
        return \view('user.import');
    }

    public function import()
    {
        $oFile = \request()->file('file');
        Excel::import(new ImportHei, $oFile);
        return back();
    }
}
