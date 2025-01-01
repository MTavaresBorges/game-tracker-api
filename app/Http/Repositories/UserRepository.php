<?php

namespace App\Http\Repositories;

use App\Models\User;
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
            $user->libraries()->create([
                'user_id' => $user->id,
                'name' => 'Beaten Games',
                'description' =>  'A collection of games I have beaten',
                'is_main' => true,
            ]);
        });
    }
    
    public function delete(User $user)
    {
        $user->delete();
    }
}