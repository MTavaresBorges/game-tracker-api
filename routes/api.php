<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\LibraryController;

Route::apiResource('users', UserController::class);
Route::get('/states', [StateController::class,'getAll']);

Route::post('/login', [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/games', GameController::class);
    Route::apiResource('/libraries', LibraryController::class);
    Route::post('/logout', [AuthController::class,'logout']);
});