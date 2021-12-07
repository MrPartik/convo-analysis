<?php namespace App\Http\Livewire;

use App\Imports\ImportAcademicYear;
use App\Imports\ImportHei;
use App\Imports\ImportHeiData;
use App\Imports\ImportProgram;
use App\Jobs\ImportExcelBackground;
use App\Models\HeiModel;
use App\Models\queueJobModel;
use Cloudinary\Api\Exception\ApiError;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

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
    public $bFollowExcelRegion = false;
    private $oFileSystem, $sStoragePath;

    public function __construct($id = null)
    {
//        $o = file_get_contents('https://res.cloudinary.com/hylcjkh8s/raw/upload/v1612552200/fcexc3u6xcxjigyjmznm.xlsx');
//        $s = file_put_contents(base_path('..\tmp\fcexc3u6xcxjigyjmznm.xlsx'), $o);
//        dd(new UploadedFile(base_path('..\tmp\fcexc3u6xcxjigyjmznm.xlsx'), 'asd.xls'));
        $this->oFileSystem = Storage::disk('local');
        $this->sStoragePath = $this->oFileSystem->path('livewire-tmp\\');
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
//        $this->success = 'Hei data was on the queue, please wait util the import is finished.!';
        $this->success = 'Hei data was successfully inserted!';
        $this->clear();
    }

    public function importSuc()
    {
        $this->validate([
            'sucFile' => 'required',
        ]);
        $this->prepareQueueImport($this->heiFile, 'SUC');
        $this->clearInput();
//        $this->success = 'SUC data was on the queue, please wait util the import is finished.!';
        $this->success = 'SUC data was successfully inserted!';
        $this->clear();
    }

    public function importLuc()
    {
        $this->validate([
            'lucFile' => 'required',
        ]);
        $this->prepareQueueImport($this->heiFile, 'LUC');
        $this->clearInput();
//        $this->success = 'LUC data was on the queue, please wait util the import is finished.!';
        $this->success = 'LUC data was successfully inserted!';
        $this->clear();
    }

    public function importPheis()
    {
        $this->validate([
            'pheisFile' => 'required',
        ]);
        $this->prepareQueueImport($this->heiFile, 'PHEIS');
        $this->clearInput();
//        $this->success = 'PHEIS data was on the queue, please wait util the import is finished.!';
        $this->success = 'PHEIS data was successfully inserted!';
        $this->clear();
    }

    public function importProgram()
    {
        $this->validate([
            'programFile' => 'required',
        ]);
        $this->prepareQueueImport($this->programFile, 'PROGRAM');
        $this->clearInput();
//        $this->success = 'Program data was on the queue, please wait util the import is finished.!';
        $this->success = 'Program data was successfully inserted!';
        $this->clear();
    }


    public function importAcademicYear()
    {
        $this->validate([
            'academicYearFile' => 'required',
        ]);
        $this->prepareQueueImport($this->academicYearFile, 'YEAR');
        $this->clearInput();
//        $this->success = 'Academic Year data was on the queue, please wait util the import is finished.!';
        $this->success = 'Academic Year data was successfully inserted!';
        $this->clear();
    }


    public function importGraduate()
    {
        $this->validate([
            'graduateFile' => 'required',
        ]);
        $this->prepareQueueImport($this->graduateFile, 'GRADUATE');
        $this->clearInput();
//        $this->success = 'Graduate Student data was on the queue, please wait util the import is finished.!';
        $this->success = 'Graduate Student data was successfully inserted!';
        $this->clear();
    }


    public function importEnrollment()
    {
        $this->validate([
            'enrollmentFile' => 'required',
        ]);
        $this->prepareQueueImport($this->enrollmentFile, 'ENROLLMENT');
        $this->clearInput();
//        $this->success = 'Enrollment Student data was on the queue, please wait util the import is finished.!';
        $this->success = 'Enrollment Student data was successfully inserted!';
        $this->clear();
    }

    private function prepareQueueImport(UploadedFile $oFile, $sType){

        try {
//            $sPath = $oFile->storeOnCloudinary()->getSecurePath();
//            $oQueue = new queueJobModel();
//            $oQueue->file = $sPath;
//            $oQueue->file = $oFile->getFilename();
//            $oQueue->type = $sType;
//            $oQueue->save();
//            file_put_contents(\base_path('tmp/'. $oFile->getFilename()), $oFile->getFilename());
//            ImportExcelBackground::dispatch()->delay('3');
//            $this->getFile($oFile->getFilename()
            if ($sType === 'HEI') Excel::import(new ImportHei(HeiModel::class, $sType, $this->bFollowExcelRegion), $oFile);
            else if ($sType === 'SUC') Excel::import(new ImportHei(HeiModel::class, 'SUC', $this->bFollowExcelRegion), $oFile);
            else if ($sType === 'LUC') Excel::import(new ImportHei(HeiModel::class, 'LUC', $this->bFollowExcelRegion), $oFile);
            else if ($sType === 'PHEIS') Excel::import(new ImportHei(HeiModel::class, 'PHEIS', $this->bFollowExcelRegion), $oFile);
            else if ($sType === 'PROGRAM') Excel::import(new ImportProgram, $oFile);
            else if ($sType === 'YEAR') Excel::import(new ImportAcademicYear, $oFile);
            else if ($sType === 'GRADUATE') Excel::import(new ImportHeiData('GRADUATE'), $oFile);
            else if ($sType === 'ENROLLMENT') Excel::import(new ImportHeiData('ENROLLMENT'), $oFile);
        } catch (ApiError $e) {
            return $this->addError('Unexpected Error', 'Unexpected error, trying to import file on queue.');
        }
    }

    private function getFile($sFile)
    {
        return new UploadedFile($this->sStoragePath . $sFile, $sFile);
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
