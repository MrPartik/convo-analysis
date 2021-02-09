<?php

namespace App\Http\Livewire;

use App\Repositories\derivedRepository;
use Livewire\Component;

class Thread extends Component
{
    public $aProgramReportData;
    public function render()
    {
        return view('livewire.thread');
    }

    public function getProgramReportData($sType, $bIsEnrollment) {
        $this->aProgramReportData = derivedRepository::getProgramReportData($sType, $bIsEnrollment);
    }
}
