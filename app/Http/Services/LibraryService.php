<?php

namespace App\Http\Services;

use App\Http\Repositories\LibraryRepository;


class LibraryService
{
    protected $libraryRepository;
    public function __construct(LibraryRepository $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
    }

    public function create(array $data)
    {
        return $this->libraryRepository->create($data);
    }
}