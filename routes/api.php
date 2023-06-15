<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/verifyAuth', [AuthController::class, 'verifyAuth']);
    //user
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::post('/user/delete', [UserController::class, 'destroy']);


});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


