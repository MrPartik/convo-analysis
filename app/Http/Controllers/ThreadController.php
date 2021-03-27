<?php namespace App\Http\Controllers;

use App\Models\ConvoModel;
use App\Models\HeiModel;
use App\Models\ProgramModel;
use App\Repositories\derivedRepository;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function front()
    {
        return \view('user.thread', [
            'programByCity' => (new derivedRepository(new HeiModel(), new ProgramModel(), new ConvoModel()))->programByCity()
        ]);
    }
}
