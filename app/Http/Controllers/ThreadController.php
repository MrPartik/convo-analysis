<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function front()
    {
        return \view('user.thread');
    }
}
