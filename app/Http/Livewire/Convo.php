<?php

namespace App\Http\Livewire;

use App\Models\ConvoModel;
use App\Repositories\convoRepository;
use App\WitApp;
use Illuminate\Support\Facades\Auth;
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
        $oConvo = new ConvoModel();
        $oConvo->user_id = Auth::id();
        $oConvo->message = $this->sContent;
        $oConvo->reply_user_id = 1;
        $oConvo->save();
        $this->oConvos = convoRepository::getConvoPerLogin();
        $this->reply($this->sContent);
        $this->sContent = '';
    }

    private function reply(string $sContent)
    {
        convoRepository::reply($sContent);
        $this->emit('scrollToLatest');
    }
}
