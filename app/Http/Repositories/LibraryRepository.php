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

    public function findMain()
    {
        return Library::where('is_main', 1)->where('user_id', auth()->user()->id)->first();
    }
}