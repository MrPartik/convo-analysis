<?php namespace App\Http\Livewire;

use App\Imports\ImportHei;
use App\Imports\ImportLuc;
use App\Imports\ImportPheis;
use App\Imports\ImportProgram;
use App\Imports\ImportSuc;
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
        Excel::import(new ImportHei, $this->heiFile);
        $this->heiFile = '';
        $this->programFile = '';
        $this->sucFile = '';
        $this->lucFile = '';
        $this->pheisFile = '';
        $this->success = 'Hei data was successfully imported!';
        $this->clear();
    }

    public function importSuc()
    {
        $this->validate([
            'sucFile' => 'required',
        ]);
        Excel::import(new ImportSuc, $this->sucFile);
        $this->heiFile = '';
        $this->programFile = '';
        $this->sucFile = '';
        $this->lucFile = '';
        $this->pheisFile = '';
        $this->success = 'SUC data was successfully imported!';
        $this->clear();
    }

    public function importLuc()
    {
        $this->validate([
            'lucFile' => 'required',
        ]);
        Excel::import(new ImportLuc, $this->lucFile);
        $this->heiFile = '';
        $this->programFile = '';
        $this->sucFile = '';
        $this->lucFile = '';
        $this->pheisFile = '';
        $this->success = 'LUC data was successfully imported!';
        $this->clear();
    }

    public function importPheis()
    {
        $this->validate([
            'pheisFile' => 'required',
        ]);
        Excel::import(new ImportPheis, $this->pheisFile);
        $this->heiFile = '';
        $this->programFile = '';
        $this->sucFile = '';
        $this->lucFile = '';
        $this->pheisFile = '';
        $this->success = 'PHEIS data was successfully imported!';
        $this->clear();
    }

    public function importProgram()
    {
        $this->validate([
            'programFile' => 'required',
        ]);
        Excel::import(new ImportProgram, $this->programFile);
        $this->heiFile = '';
        $this->programFile = '';
        $this->sucFile = '';
        $this->lucFile = '';
        $this->pheisFile = '';
        $this->success = 'Program data was successfully imported!';
        $this->clear();
    }

    private function clear()
    {
        $this->clearValidation();
        $this->emit('success');
    }

}
