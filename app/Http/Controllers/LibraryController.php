<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Services\LibraryService;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;

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

    public function index()
    {
        $libraries = $this->libraryService->getAllByUser();
        return response()->json($libraries, 200);
    }

    public function show($id)
    {
        $library = $this->libraryService->getById($id);
        return response()->json($library, 200);
    }

    public function update($id, UpdateLibraryRequest $request)
    {
        $library = $this->libraryService->update($id, $request->validated());
        return response()->json($library, 200);
    }

    public function destroy($id)
    {
        $library = $this->libraryService->delete($id);
        return response()->json($library, 200);
    }
}
