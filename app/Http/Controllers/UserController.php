<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function index() {
        return User::all();
    }

    public function show($id = null) {
        $user = $this->userService->getById($id);
        return response()->json($user, 200);
    }

    public function store(StoreUserRequest $request){
        $user = $this->userService->create($request->validated());
        return response()->json($user, 201);
    }

    public function update($id, UpdateUserRequest $request) {
        $user = $this->userService->update($request->validated(), $id);
        return response()->json($user, 200);
    }

    public function currentUser(Request $request) {
        return response()->json($request->user());
    }
}
