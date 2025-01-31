<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    public function update(array $data, $id)
    {
        $user = User::find($id);
        $user->update($data);

        return $user;
    }

    public function getById($id)
    {
        if (!$id) {
            return Auth::user();
        }

        return User::findOrFail($id);
    }
}