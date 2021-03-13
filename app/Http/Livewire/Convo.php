<?php

namespace App\Http\Livewire;

use App\Models\ConvoModel;
use App\Repositories\convoRepository;
use App\Services\convoService;
use App\WitApp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Convo extends Component
{
    private $oConvoService;

    private $oConvoRepository;

    public $oConvos;

    public $sContent;

    public $rules = [
        'sContent' => 'required'
    ];

    public function __construct($id = null)
    {
        $this->oConvoService = new convoService();
        $this->oConvoRepository = new convoRepository();
        parent::__construct($id);
    }

    public function render()
    {
        $this->oConvos = $this->oConvoRepository->getConvoPerLogin();

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
        $this->oConvos = $this->oConvoRepository->getConvoPerLogin();
        $mReply = $this->oConvoService->reply($this->sContent);
        if($mReply === false) {
            return $this->emit('errorOccurMessage');
        }
        $oConvo->save();
        ConvoModel::insert($mReply);
        $this->sContent = '';
        $this->emit('scrollToLatest');
    }
}
