<?php namespace App\Http\Controllers;

use App\Repositories\derivedRepository;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function front()
    {
        return \view('user.thread', [
            'programByCity' => derivedRepository::programByCity()
        ]);
    }
}
