<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibraryRequest;
use App\Http\Services\LibraryService;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected $libraryService;
    public function __construct(LibraryService $libraryService )
    {
        $this->libraryService = $libraryService;
    }

    public function store(StoreLibraryRequest $request)
    {
        $library = $this->libraryService->create($request->validated(), $request->file('file'));
        return response()->json($library, 201);
    }
}
