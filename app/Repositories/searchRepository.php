<?php namespace App\Repositories;

use App\Models\ProgramModel;

class searchRepository
{

    /**
     * @var ProgramModel
     */
    private $oProgramModel;

    /**
     * searchRepository constructor.
     * @param ProgramModel $oProgramModel
     */
    public function __construct(ProgramModel $oProgramModel)
    {
        $this->oProgramModel = $oProgramModel;
    }

    public function searchProgram($sValue, $iLength = 5)
    {
        return $this->oProgramModel::where(
            'program', 'LIKE', '%' . $sValue . '%'
        )->distinct('program')->limit($iLength)->pluck('program');
    }

}
