<?php

namespace App\Http\Livewire;

use App\Repositories\convoRepository;
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
        $oConvo = new \App\Models\convo();
        $oConvo->user_id = Auth::id();
        $oConvo->message = $this->sContent;
        $oConvo->reply_user_id = 1;
        $oConvo->save();
        $this->sContent = '';
        $this->oConvos = convoRepository::getConvoPerLogin();
        $this->emit('scrollToLatest');
    }
}
