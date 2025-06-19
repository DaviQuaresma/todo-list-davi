<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);
});


Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    Route::apiResource('todolists', TodoListController::class);
});


Route::middleware(['auth:api'])->group(function () {

    Route::get('/todolists/{id}/tasks', [TaskController::class, 'index']);
    Route::post('/todolists/{id}/tasks', [TaskController::class, 'store']);
    Route::patch('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/todolists/{id}/tasks', [TaskController::class, 'index']);
});
