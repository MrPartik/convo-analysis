<?php

namespace App\Http\Livewire;

use App\Models\ConvoModel;
use App\Models\HeiModel;
use App\Models\ProgramModel;
use App\Repositories\derivedRepository;
use Livewire\Component;

class Thread extends Component
{
    public $aProgramReportData = [];
    public $sType = 'SUC';
    public $sTypeForDb = 'SUC';
    public $sStudentData = 'enrollment';

    public function render()
    {
        if ($this->aProgramReportData === []) $this->getProgramReportData('SUC');
        return view('livewire.thread');
    }

    public function getProgramReportData($sType)
    {
        switch ($sType) {
            case 'SUC' : $this->sType = 'SUCs'; break;
            case 'LUC' : $this->sType = 'LUCs'; break;
            case 'PRIVATE' : $this->sType = 'PHEIs'; break;
            case 'ALL' : $this->sType = 'HEIs'; break;
        }

        $this->sTypeForDb = $sType;
        $this->aProgramReportData = (new derivedRepository(new HeiModel(), new ProgramModel(), new ConvoModel()))->getProgramReportData($this->sTypeForDb, ($this->sStudentData === 'enrollment'));
    }

    public function updateStudentData()
    {
        $this->aProgramReportData = (new derivedRepository(new HeiModel(), new ProgramModel(), new ConvoModel()))->getProgramReportData($this->sTypeForDb, ($this->sStudentData === 'enrollment'));
    }
}
