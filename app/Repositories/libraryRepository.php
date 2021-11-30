<?php namespace App\Repositories;

use App\Models\ProgramModel;

class libraryRepository {


    private $oProgramModel;

    public function __construct()
    {
        $this->oProgramModel = new ProgramModel();
    }

    public function getAllPrograms()
    {
        return $this->oProgramModel::distinct('program')->pluck('program');
    }
}
