<?php namespace App\Services;

use App\Repositories\libraryRepository;

class libraryService
{

    /**
     * @var libraryRepository
     */
    public $oLibraryRepository;

    public function __construct(libraryRepository $oLibraryRepository)
    {
        $this->oLibraryRepository = $oLibraryRepository;
    }

    public function getAllPrograms()
    {
        return $this->oLibraryRepository->getAllPrograms();
    }
}
