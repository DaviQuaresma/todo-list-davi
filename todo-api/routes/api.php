<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TaskController;

// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/teste-cors', fn() => response()->json(['ok' => true]));

// Rotas protegidas
Route::middleware(['auth:api'])->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    // Todo Lists
    Route::apiResource('todolists', TodoListController::class);

    // Tasks
    Route::get('/todolists/{id}/tasks',    [TaskController::class, 'index']);
    Route::post('/todolists/{id}/tasks',   [TaskController::class, 'store']);
    Route::patch('/tasks/{id}',            [TaskController::class, 'update']);
    Route::delete('/tasks/{id}',           [TaskController::class, 'destroy']);
});
