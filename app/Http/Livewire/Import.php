<?php namespace App\Http\Livewire;

use App\Imports\ImportAcademicYear;
use App\Imports\ImportHei;
use App\Imports\ImportProgram;
use App\Imports\ImportHeiData;
use App\Models\HeiModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    public $heiFile = '';
    public $sucFile = '';
    public $lucFile = '';
    public $pheisFile = '';
    public $academicYearFile = '';
    public $enrollmentFile = '';
    public $graduateFile = '';
    public $programFile = '';
    public $success = '';

    public function render()
    {
        return view('livewire.import');
    }

    public function importHei()
    {
        $this->validate([
            'heiFile' => 'required',
        ]);
        Excel::import(new ImportHei(HeiModel::class, ''), $this->heiFile);
        $this->clearInput();
        $this->success = 'Hei data was successfully imported!';
        $this->clear();
    }

    public function importSuc()
    {
        $this->validate([
            'sucFile' => 'required',
        ]);
        Excel::import(new ImportHei(HeiModel::class, 'SUC'), $this->sucFile);
        $this->clearInput();
        $this->success = 'SUC data was successfully imported!';
        $this->clear();
    }

    public function importLuc()
    {
        $this->validate([
            'lucFile' => 'required',
        ]);
        Excel::import(new ImportHei(HeiModel::class, 'LUC'), $this->lucFile);
        $this->clearInput();
        $this->success = 'LUC data was successfully imported!';
        $this->clear();
    }

    public function importPheis()
    {
        $this->validate([
            'pheisFile' => 'required',
        ]);
        Excel::import(new ImportHei(HeiModel::class, 'PHEIS'), $this->pheisFile);
        $this->clearInput();
        $this->success = 'PHEIS data was successfully imported!';
        $this->clear();
    }

    public function importProgram()
    {
        $this->validate([
            'programFile' => 'required',
        ]);
        Excel::import(new ImportProgram, $this->programFile);
        $this->clearInput();
        $this->success = 'Program data was successfully imported!';
        $this->clear();
    }


    public function importAcademicYear()
    {
        $this->validate([
            'academicYearFile' => 'required',
        ]);
        Excel::import(new importAcademicYear, $this->academicYearFile);
        $this->clearInput();
        $this->success = 'Academic Year data was successfully imported!';
        $this->clear();
    }


    public function importGraduate()
    {
        $this->validate([
            'graduateFile' => 'required',
        ]);
        Excel::import(new ImportHeiData('graduate'), $this->graduateFile);
        $this->clearInput();
        $this->success = 'Graduate Student data was successfully imported!';
        $this->clear();
    }


    public function importEnrollment()
    {
        $this->validate([
            'enrollmentFile' => 'required',
        ]);
        Excel::import(new ImportHeiData('enrollment'), $this->enrollmentFile);
        $this->clearInput();
        $this->success = 'Enrollment Student data was successfully imported!';
        $this->clear();
    }

    private function clearInput()
    {
        $this->heiFile = '';
        $this->programFile = '';
        $this->sucFile = '';
        $this->lucFile = '';
        $this->pheisFile = '';
        $this->academicYearFile = '';
        $this->enrollmentFile = '';
        $this->graduateFile = '';
    }

    private function clear()
    {
        $this->emit('success');
        $this->clearValidation();
    }

}
