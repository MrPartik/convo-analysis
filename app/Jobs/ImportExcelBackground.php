<?php

namespace App\Jobs;

use App\Imports\ImportAcademicYear;
use App\Imports\ImportHei;
use App\Imports\ImportHeiData;
use App\Imports\ImportProgram;
use App\Models\HeiModel;
use App\Models\queueJobModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelBackground implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $oFileSystem;
    private $sStoragePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->oFileSystem = Storage::disk('local');
        $this->sStoragePath = $this->oFileSystem->path('livewire-tmp');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $oQueue = queueJobModel::where('is_imported', 0)->orderBy('id', 'DESC')->first();
            Log::info('ImportManager:start ' . time());
            if ($oQueue !== null) {
                if ($oQueue->type === 'HEI') Excel::import(new ImportHei(HeiModel::class, $oQueue->type), $this->getFile($oQueue->file));
                else if ($oQueue->type === 'SUC') Excel::import(new ImportHei(HeiModel::class, 'SUC'), $this->getFile($oQueue->file));
                else if ($oQueue->type === 'LUC') Excel::import(new ImportHei(HeiModel::class, 'LUC'), $this->getFile($oQueue->file));
                else if ($oQueue->type === 'PHEIS') Excel::import(new ImportHei(HeiModel::class, 'PHEIS'), $this->getFile($oQueue->file));
                else if ($oQueue->type === 'PROGRAM') Excel::import(new ImportProgram, $this->getFile($oQueue->file));
                else if ($oQueue->type === 'YEAR') Excel::import(new ImportAcademicYear, $this->getFile($oQueue->file));
                else if ($oQueue->type === 'GRADUATE') Excel::import(new ImportHeiData('GRADUATE'), $this->getFile($oQueue->file));
                else if ($oQueue->type === 'ENROLLMENT') Excel::import(new ImportHeiData('ENROLLMENT'), $this->getFile($oQueue->file));
                $oQueue->is_imported = 1;
                $oQueue->save();
            }
            Log::info('ImportManager:done ' . time());
            return 0;
        } catch (\Exception $oExcept) {
            Log::info('ImportManager:error ' . $oExcept->getMessage());
        }
    }

    private function getFile($sFile)
    {
        return new UploadedFile($this->sStoragePath . '/' . $sFile, $sFile);
    }
}
