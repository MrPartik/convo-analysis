<?php

namespace App\Http\Controllers;

use App\Imports\ImportHei;
use App\Models\HeiModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function front()
    {
        return \view('import');
    }
}
