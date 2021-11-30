<?php

namespace App\Http\Livewire;

use App\Repositories\libraryRepository;
use App\Services\libraryService;
use App\WitApp;
use Livewire\Component;

class Library extends Component
{
    private $oWitApp;
    private $oLibrary;

    public $aIntents = [];
    public $aUtterances = [];
    public $aPrograms = [];

    public $sIntent = 'all';
    public $iLimit = 10;
    public $iOffset = 0;
    public $iPage = 1;
    public $aEntities = [];

    public $bIsTrainModalShown = false;
    public $bIsEntityModalShown = false;

    public $utteranceText = '';
    public $intentValue = '';
    public $entityToRecallValue = '';
    public $assignedEntityValue = '';
    public $trainResponse = [];

    public $entityProgram = '';
    public $entityCustomText = '';

    public $aRulesAddEntity = [
        'entityCustomText' => 'required_if:entityProgram, ""'
    ];

    public $aRulesTrainBrixbo = [
        'intentValue' => 'required',
        'utteranceText' => 'required',
        'assignedEntityValue' => 'required_with:entityToRecallValue'
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->oWitApp = new WitApp();
        $this->oLibrary = new libraryService(new libraryRepository());
    }

    public function hydrate()
    {
        $this->emit('select2');
        $this->trainResponse = [];
    }

    public function render()
    {
        $this->getIntents();
        $this->getEntities();
        $this->updateUtterance();
        $this->aPrograms = $this->oLibrary->getAllPrograms();
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
        $aEntities = array_filter($aEntities, function ($sEntity) {
            return !preg_match('/wit\$/', $sEntity) && preg_match('/_([A-Za-z_]+)_/', $sEntity);
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
        $this->utteranceText = '';
        $this->intentValue = '';
        $this->entityToRecallValue = '';
        $this->assignedEntityValue = '';
        $this->bIsTrainModalShown = true;
    }

    public function showEntityModal()
    {
        $this->entityProgram = '';
        $this->entityCustomText = '';
        $this->bIsTrainModalShown = false;
        $this->bIsEntityModalShown = true;
    }

    public function saveEntity()
    {
        $this->validate($this->aRulesAddEntity);
        //@TODO
    }

    public function trainBrixbo()
    {
        try {
            $this->validate($this->aRulesTrainBrixbo);
            $iIndex = strrpos($this->utteranceText, $this->entityToRecallValue);
            $sSubstring = substr($this->utteranceText, $iIndex, strlen($this->entityToRecallValue));
            $aData = [
                [
                    'text' => $this->utteranceText,
                    'intent' => $this->intentValue,
                    'entities' => [
                        [
                            'entity' => $this->assignedEntityValue . ':' . $this->assignedEntityValue,
                            'start' => $iIndex,
                            'end' => $iIndex + strlen($sSubstring),
                            'body' => $this->entityToRecallValue,
                            'entities' => []
                        ]
                    ],
                    'traits' => []
                ]
            ];
            $aResponse = $this->oWitApp->trainApp($aData);
            if (array_key_exists('sent', $aResponse) === true && $aResponse['sent'] === true) {
                $this->trainResponse = [
                    'status' => true,
                    'message' => 'You have successfully submitted the train data. Please wait training ongoing.'
                ];
            } else {
                $this->trainResponse = [
                    'status' => false,
                    'message' => 'Something went wrong, please check the data and try again'
                ];
            }
        } catch (\Exception | ErrorException $aException) {
            $this->trainResponse = [
                'status' => false,
                'message' => 'Something went wrong, please check the data and try again'
            ];
        } finally {
            $this->intentValue = '';
            $this->assignedEntityValue = '';
            $this->entityToRecallValue = '';
            $this->utteranceText = '';
        }
    }

}
