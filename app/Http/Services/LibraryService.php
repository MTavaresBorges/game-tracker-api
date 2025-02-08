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

    public function getAllByUser(){
        return Library::with('games')->where('user_id', auth()->user()->id)->get();
    }

    public function getById($id){
        return Library::with('games.libraries')->where('id', $id)->first();
    }

    public function update($id, array $data){
        $library = Library::where('id', $id)->update($data);
        
        return $library;
    }

    public function delete($id){
        $library = Library::where('id', $id)->delete();
        return response()->json($library, 200);
    }
}