<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function front()
    {
        return \view('user.import');
    }
}
