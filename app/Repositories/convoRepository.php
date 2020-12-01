<?php namespace App\Repositories;

use App\Models\convo;
use Illuminate\Support\Facades\Auth;

class convoRepository
{


    public static function getConvoPerLogin()
    {
        return convo::with(['repliedUser', 'messageUser'])->where('user_id', Auth::id())
            ->orWhere('reply_user_id', Auth::id())
            ->get();
    }
}