<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

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
        return DB::transaction(function () use ($data) {
            $user = User::create($data);
            $user->addresses()->create($data['address']);
        });
    }
    
    public function delete(User $user)
    {
        $user->delete();
    }
}