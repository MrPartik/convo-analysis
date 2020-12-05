<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
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
        Excel::import(new ExcelImport, $oFile);
        return back();
    }
}
