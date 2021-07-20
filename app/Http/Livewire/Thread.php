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
    public $aAcademicData = [];
    public $aRegionReportData = [];
    public $sType = 'SUC';
    public $sTypeForDb = 'SUC';
    public $sStudentData = 'enrollment';
    public $iYear = 2017;
    public $sAcademicYear = '2017-2018';
    private $oDerivedData;
    private $aFormattedAcademicYear = [];
    /**
     * @value
     * 0 = default
     * 1 = hei per enrollment | graduation data
     * @var int
     */
    public $iDashboardType = 0;

    public function __construct($id = null)
    {
        $this->oDerivedData = new derivedRepository();
        ($this->aProgramReportData === []) && $this->getProgramReportData('SUC');
        $this->aFormattedAcademicYear = $this->oDerivedData->getAcademicYear();
        ($this->aAcademicData === []) && $this->getCountHEIs();
        parent::__construct($id);
    }

    public function render()
    {
        return view('livewire.thread', [
            'aYears' => $this->aFormattedAcademicYear
        ]);
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
        $this->aProgramReportData = $this->oDerivedData->getProgramReportData($this->sTypeForDb, ($this->sStudentData === 'enrollment'));
    }

    public function updateStudentData()
    {
        $this->aProgramReportData = $this->oDerivedData->getProgramReportData($this->sTypeForDb, ($this->sStudentData === 'enrollment'));
    }

    public function setDashboardType($iType) {
        $this->iDashboardType = $iType;
    }

    public function getCountHEIs()
    {
        $aData = $this->oDerivedData->getDataPerAcademicYear($this->iYear, ($this->sStudentData === 'enrollment'));
        $this->aAcademicData = $aData['hei'];
        $this->aRegionReportData = $aData['region'];
        $this->sAcademicYear = $this->aFormattedAcademicYear[$this->iYear];
    }
}
