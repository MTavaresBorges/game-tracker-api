<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Repositories\LibraryRepository;


class UserService
{
    protected $userRepository;
    protected $libraryRepository;
    public function __construct(UserRepository $userRepository, LibraryRepository $libraryRepository)
    {
        $this->userRepository = $userRepository;
        $this->libraryRepository = $libraryRepository;
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }
}