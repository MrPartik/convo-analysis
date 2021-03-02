<?php

namespace App\Http\Livewire;

use App\Repositories\derivedRepository;
use Livewire\Component;

class Thread extends Component
{
    public $aProgramReportData = [];
    public $sType = 'SUC';
    public function render()
    {
        if($this->aProgramReportData === [])  $this->getProgramReportData('SUC', true);
        return view('livewire.thread');
    }

    public function getProgramReportData($sType, $bIsEnrollment) {
        $this->sType = $sType;
        $this->aProgramReportData = derivedRepository::getProgramReportData($sType, $bIsEnrollment);
    }
}
