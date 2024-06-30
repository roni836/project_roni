<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::middleware('auth.api')->group(function () {
    Route::post('/todo/add', [TaskController::class, 'addTask']);
    Route::post('/todo/status', [TaskController::class, 'updateTaskStatus']);
// });