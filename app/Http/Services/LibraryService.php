<?php

namespace App\Http\Services;

use App\Models\Library;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\LibraryRepository;
use Illuminate\Http\UploadedFile;

class LibraryService
{
    protected $libraryRepository;
    public function __construct(LibraryRepository $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
    }

    public function create(array $data, $file)
    {
        if ($file) {
            $path = $file->store('libraries', 'public');
            $data['img_path'] = $path;
        }

        $data['user_id'] = auth()->user()->id;
        $library = Library::create($data, ['is_main' => false]);
        
        return $library;
    }
}