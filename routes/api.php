<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\LibraryController;
use App\Http\Middleware\CorsMiddleware;

// Route::apiResource('users', UserController::class);

Route::post('users', [UserController::class,'store']);
Route::get('/states', [StateController::class,'getAll']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('users')->controller(UserController::class)->group(function () {
            Route::get('/', 'currentUser');
            Route::put('/{id}', 'update');
        });
        Route::apiResource('/games', GameController::class);
        Route::apiResource('/libraries', LibraryController::class);
        Route::post('/logout', [AuthController::class,'logout']);
    });
});