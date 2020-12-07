<?php namespace App\Http\Livewire;

use App\Imports\ImportHei;
use App\Imports\ImportProgram;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    public $heiFile = '';
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
        $this->success = 'Hei data was successfully imported!';
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
        $this->success = 'Program data was successfully imported!';
        $this->clear();
    }

    private function clear()
    {
        $this->clearValidation();
        $this->emit('success');
    }

}
