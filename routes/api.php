<?php

use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [APIAuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('/tasks', [APIController::class, 'adminGetAllTasks'])->middleware('role');
    Route::get('/task/{id}', [APIController::class, 'getTask']);
    Route::get('/tasks/completed', [APIController::class, 'getCompletedTasks']);
    Route::get('/tasks/pending', [APIController::class, 'getPendingTasks']);
    Route::get('/tasks/overdue', [APIController::class, 'getOverdueTasks']);
    Route::post('/task/create', [APIController::class, 'adminCreateTask'])->middleware('role');
    Route::delete('/task/delete/{id}', [APIController::class, 'adminDeleteTask'])->middleware('role');
    Route::put('/task/update/{id}', [APIController::class, 'adminUpdateTask'])->middleware('role');
    Route::post('/logout', [APIAuthController::class, 'logout']);
    Route::get('/tokens/create', [APIAuthController::class, 'getToken']);
});
