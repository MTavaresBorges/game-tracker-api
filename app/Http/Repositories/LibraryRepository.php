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
}