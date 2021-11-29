<?php

namespace App\Http\Livewire;

use App\WitApp;
use Livewire\Component;

class Library extends Component
{
    private $oWitApp;
    public $aIntents = [];
    public $aUtterances = [];
    public $sIntent = 'all';
    public $iLimit = 10;
    public $iOffset = 0;
    public $iPage = 1;
    public $bIsTrainModalShown = false;
    public $aEntities = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->oWitApp = new WitApp();
    }

    public function render()
    {
        $this->getIntents();
        $this->getEntities();
        $this->updateUtterance();
        return \view('livewire.library');
    }

    public function getUtterance(int $iOffset = 0, int $iLimit = 10, string $sIntent = 'all')
    {
        $this->aUtterances = $this->oWitApp->getUtterances($iOffset, $iLimit, $sIntent);
    }

    public function nextPage()
    {
        $this->iOffset += ($this->iLimit * 2);
        $this->iPage++;
        $this->updateUtterance();
    }

    public function previousPage()
    {
        if ($this->iPage > 1) {
            $this->iOffset -= ($this->iLimit * 2);
            $this->iPage--;
            $this->updateUtterance();
        }
    }

    public function getIntents()
    {
        $this->aIntents = $this->oWitApp->getIntents();
        $this->emitUp('refresh');
    }

    public function getEntities()
    {
        $aEntities = $this->oWitApp->getEntities();
        $aEntities = array_filter($aEntities, function($sEntity) {
            return !preg_match('/wit\$/', $sEntity);
        });
        $this->aEntities = $aEntities;
        $this->emitUp('refresh');
    }

    public function updateUtterance()
    {
        $this->getUtterance($this->iOffset, $this->iLimit, $this->sIntent);
        $this->emitUp('refresh');
    }

    public function reload()
    {
        $this->iOffset = (($this->iPage - 1) * $this->iLimit);
        $this->getIntents();
        $this->updateUtterance();
        $this->emitUp('refresh');
    }

    public function showTrainModal()
    {
        $this->bIsTrainModalShown = true;
    }

    public function hideTrainModal()
    {
        $this->bIsTrainModalShown = false;
    }

}
