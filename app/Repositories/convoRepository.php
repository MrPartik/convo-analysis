<?php namespace App\Repositories;

use App\Models\convoModel;
use Illuminate\Support\Facades\Auth;

class convoRepository
{

    public static function getConvoPerLogin()
    {
        return convoModel::with(['repliedUser', 'messageUser'])->where('user_id', Auth::id())
            ->orWhere('reply_user_id', Auth::id())
            ->get();
    }
}
