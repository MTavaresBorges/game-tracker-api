<?php

namespace App\Http\Repositories;

use App\Models\Library;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LibraryRepository
{
    public function getAll()
    {
        return Library::all();
    }

    public function firstCreate()
    {
        return DB::transaction(function () {
            $library = Library::create([
                'user_id' => 1,
                'name' => 'Beaten Games',
                'description' =>  'A collection of games I have beaten',
                'is_main' => true,
            ]);
        });
    }
}