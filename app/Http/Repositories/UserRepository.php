<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function create($data)
    {
        return User::create($data);
    }
    
    public function delete(User $user)
    {
        $user->delete();
    }
}