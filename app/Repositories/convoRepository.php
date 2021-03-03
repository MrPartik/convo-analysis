<?php namespace App\Repositories;

use App\Models\ConvoModel;
use App\WitApp;
use Carbon\Carbon;
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
        $aConvo = [];
        $aContent = $oWit->getIntentByText($aContent);
        $aConvo['user_id'] = 1;
        $aConvo['message'] = self::analyzeConvo($aContent);
        $aConvo['reply_user_id'] = Auth::id();
        $aConvo['created_at'] = Carbon::now();
        if (\array_search(self::getIntent($aContent), ['getCountHei', 'getCountSuc', 'getCountLuc', 'getCountPheis']) === false ) {
            $aConvo['url'] = self::parseUrl($aContent);
        }
        if (@$aContent['entities'] === null || @$aContent['entities'] === []|| (isset($aContent['error']) === true && $aContent['error'] === true)) {
            return false;
        }
        return $aConvo;
    }

    private static function analyzeConvo($aContent)
    {
        if (\array_search(self::getIntent($aContent), ['getCountHei', 'getCountSuc', 'getCountLuc', 'getCountPheis']) !== false) {
            $mCoutHei = call_user_func(derivedRepository::class . '::' . self::getIntent($aContent));
            return 'Hello! ' . Auth::user()->name . ', as of ' . Carbon::now()->format('l M d, Y') . ' there are <span class="font-extrabold text-gray-900 text-lg">' .
                $mCoutHei['count'] . ' of ' . $mCoutHei['type'] . '</span> in our record!';
        }
        return 'Hello! ' . Auth::user()->name . ', this is the report for you, you can click this to view full report';
    }

    private static function parseUrl(array $aContent)
    {
        $sGroupby = preg_replace('/by |and /', ',', \implode(\array_column(@$aContent['entities']['groupBy'] ?? [], 'value')));
        return '?intent=' . self::getIntent($aContent) . '&by=' . $sGroupby;
    }

    private static function getIntent(array $aContent) {
        return \implode('', \array_column(@$aContent['entities']['intent'] ?? [], 'value'));
    }
}
