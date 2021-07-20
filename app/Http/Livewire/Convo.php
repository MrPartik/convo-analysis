<?php

namespace App\Http\Livewire;

use App\Models\ConvoModel;
use App\Models\HeiModel;
use App\Models\ProgramModel;
use App\Repositories\convoRepository;
use App\Repositories\derivedRepository;
use App\Repositories\searchRepository;
use App\Services\convoService;
use App\WitApp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Convo extends Component
{
    private $oConvoService;
    public $oConvos;
    public $sContent;
    public $aSearchedPrograms;
    public $rules = [
        'sContent' => 'required'
    ];

    /**
     * Convo constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->oConvoService = new convoService(new convoRepository(), new derivedRepository(), new searchRepository(new ProgramModel()));
        parent::__construct($id);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->oConvos = $this->oConvoService->getConvoPerLogin();

        return view('livewire.convo', [
            'convos' => $this->oConvos
        ]);
    }

    /**
     * @return array|mixed
     */
    public function triggerSearchProgram()
    {
        \preg_match_all('/{{[a-z0-9\s]+/i', $this->sContent, $mProgram);
        \preg_match_all('/{{[a-z0-9\s]+}}/i', $this->sContent, $mProgramDone);
        $this->aSearchedPrograms = $this->sContent;
        if(\count($mProgram[0]) !== \count($mProgramDone[0])) {
            return $this->aSearchedPrograms = $this->oConvoService->searchProgram(\str_replace('{{', '', @$mProgram[0][\count($mProgram[0]) - 1]));
        }
        return $this->aSearchedPrograms = [];
    }

    /**
     * @param $sSelected
     */
    public function selectProgram($sSelected)
    {
        \preg_match_all('/{{[a-z0-9\s]+/i', $this->sContent, $mProgram);
        $this->sContent = \str_replace(@$mProgram[0][\count($mProgram[0]) - 1], '{{ ' . $sSelected . ' }}', $this->sContent);
        $this->aSearchedPrograms = [];
    }

    /**
     * @return \Livewire\Event
     */
    public function sendConvo()
    {
        $this->validate();
        \preg_match_all('/{{[a-z0-9\s]+}}/i', $this->sContent, $mPrograms);
        $oConvo = new ConvoModel();
        $oConvo->user_id = Auth::id();
        $oConvo->message = \preg_replace('/{{||}}/', '', $this->sContent);
        $oConvo->reply_user_id = 1;
        $oConvo->deleted = null;
        $this->oConvos = $this->oConvoService->getConvoPerLogin();
        $mReply = $this->oConvoService->reply($this->sContent);
        if($mReply === false) {
            return $this->emit('errorOccurMessage');
        }
        $oConvo->save();
        ConvoModel::insert($mReply);
        $this->sContent = '';
        $this->emit('scrollToLatest');
    }

    public function deleteConvo()
    {
        ConvoModel::where('user_id', Auth::id())
            ->orWhere('reply_user_id', Auth::id())->update([
                'deleted' => Carbon::now()
            ]);
        $this->oConvos = $this->oConvoService->getConvoPerLogin();
    }
}
