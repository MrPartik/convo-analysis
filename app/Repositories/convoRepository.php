<?php namespace App\Repositories;

use App\Models\ConvoModel;
use App\WitApp;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Bool_;

class convoRepository
{

    public static function getConvoPerLogin()
    {
        return ConvoModel::with(['repliedUser', 'messageUser'])->where('user_id', Auth::id())
            ->orWhere('reply_user_id', Auth::id())
            ->get();
    } 

    public static function reply(string $aContent)
    {
        $oWit = new WitApp();
        $aContent = $oWit->getIntentByText($aContent);
        $oConvo = new ConvoModel();
        $oConvo->user_id = 1;
        if (@$aContent['entities']['intent'] !== null) {
            $oConvo->message = 'Hello ' . Auth::user()->name . ', this is the report for you, you can click this to view full report';
            $oConvo->url = self::parseUrl($aContent, false);
        } else {
            $oConvo->message = 'Hello ' . Auth::user()->name . ', please check your command, thank you!';
        }

        $oConvo->reply_user_id = Auth::id();
        $oConvo->save();
    }

    private static function categorizeConvo($aContent)
    {

    }

    private static function parseUrl(array $aContent)
    {
        $sIntent = \implode(\array_column(@$aContent['entities']['intent'] ?? [], 'value'));
        $sGroupby = preg_replace('/by |and /', ',', \implode(\array_column(@$aContent['entities']['groupby'] ?? [], 'value')));
        return '?intent=' . $sIntent . '&by=' . $sGroupby;
    }
}
