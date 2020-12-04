<?php

namespace App\Http\Livewire;

use App\Repositories\convoRepository;
use Illuminate\Support\Facades\Auth;
use Jeylabs\Wit\Wit;
use Livewire\Component;

class Convo extends Component
{
    public $oConvos;

    public $sContent;

    public $rules = [
        'sContent' => 'required'
    ];

    public function render()
    {
        $this->oConvos = convoRepository::getConvoPerLogin();

        return view('livewire.convo', [
            'convos' => $this->oConvos
        ]);
    }

    public function sendConvo()
    {
        $this->validate();
        $oConvo = new \App\Models\convo();
        $oConvo->user_id = Auth::id();
        $oConvo->message = $this->sContent;
        $oConvo->reply_user_id = 1;
        $oConvo->save();
        $this->oConvos = convoRepository::getConvoPerLogin();
        $wit = new Wit('JKPY6E2VOPCI52RP4CBEXLFEEMKH5I7Y', false);
        $this->reply(\json_encode($wit->getIntentByText($this->sContent)));
        $this->sContent ='';
    }

    private function reply(string $sContent)
    {
        $oConvo = new \App\Models\convo();
        $oConvo->user_id = 1;
        $oConvo->message = $sContent;
        $oConvo->reply_user_id = Auth::id();
        $oConvo->save();
        $this->emit('scrollToLatest');
    }
}
