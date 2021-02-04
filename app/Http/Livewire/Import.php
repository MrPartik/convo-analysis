<?php namespace App\Http\Livewire;

use App\Imports\ImportAcademicYear;
use App\Imports\ImportHei;
use App\Imports\ImportProgram;
use App\Imports\ImportHeiData;
use App\Jobs\ImportExcelBackground;
use App\Models\HeiModel;
use App\Models\queueJobModel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Error;
use Symfony\Component\Process\Process;

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
    private $oFileSystem;

    public function __construct($id = null)
    {
        $this->oFileSystem = Storage::disk('local');

        parent::__construct($id);
    }

    public function render()
    {
        return view('livewire.import');
    }

    public function importHei()
    {
        $this->validate([
            'heiFile' => 'required',
        ]);
        $this->prepareQueueImport($this->heiFile, 'HEI');
        $this->clearInput();
        $this->success = 'Hei data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }

    public function importSuc()
    {
        $this->validate([
            'sucFile' => 'required',
        ]);
        $this->prepareQueueImport($this->heiFile, 'SUC');
        $this->clearInput();
        $this->success = 'SUC data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }

    public function importLuc()
    {
        $this->validate([
            'lucFile' => 'required',
        ]);
        $this->prepareQueueImport($this->heiFile, 'LUC');
        $this->clearInput();
        $this->success = 'LUC data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }

    public function importPheis()
    {
        $this->validate([
            'pheisFile' => 'required',
        ]);
        $this->prepareQueueImport($this->heiFile, 'PHEIS');
        $this->clearInput();
        $this->success = 'PHEIS data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }

    public function importProgram()
    {
        $this->validate([
            'programFile' => 'required',
        ]);
        $this->prepareQueueImport($this->programFile, 'PROGRAM');
        $this->clearInput();
        $this->success = 'Program data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }


    public function importAcademicYear()
    {
        $this->validate([
            'academicYearFile' => 'required',
        ]);
        $this->prepareQueueImport($this->academicYearFile, 'YEAR');
        $this->clearInput();
        $this->success = 'Academic Year data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }


    public function importGraduate()
    {
        $this->validate([
            'graduateFile' => 'required',
        ]);
        $this->prepareQueueImport($this->graduateFile, 'GRADUATE');
        $this->clearInput();
        $this->success = 'Graduate Student data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }


    public function importEnrollment()
    {
        $this->validate([
            'enrollmentFile' => 'required',
        ]);
        $this->prepareQueueImport($this->enrollmentFile, 'ENROLLMENT');
        $this->clearInput();
        $this->success = 'Enrollment Student data was on the queue, please wait util the import is finished.!';
        $this->clear();
    }

    private function prepareQueueImport($oFile, $sType){ 
        $oQueue = new queueJobModel();
        $oQueue->file = $oFile->getFilename();
        $oQueue->type = $sType;
        $oQueue->save();
        ImportExcelBackground::dispatch();
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
