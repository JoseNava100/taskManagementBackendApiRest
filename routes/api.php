<?php

use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    /**
     * Run HTTP Request Task.
     */

Route::get('/task', [TaskController::class, 'index']);
Route::post('/task', [TaskController::class, 'store']);
Route::get('/task/{task}', [TaskController::class, 'show']);
Route::patch('/task/{task}', [TaskController::class, 'edit']);
Route::put('/task/{task}', [TaskController::class, 'update']);
Route::delete('/task/{task}', [TaskController::class, 'destroy']);

    /**
     * Run HTTP Request Role.
     */
    
Route::get('/role', [RoleController::class, 'index']);
Route::post('/role', [RoleController::class, 'store']);
Route::get('/role/{role}', [RoleController::class, 'show']);
Route::patch('/role/{role}', [RoleController::class, 'edit']);
Route::put('/role/{role}', [RoleController::class, 'update']);
Route::delete('/role/{role}', [RoleController::class, 'destroy']);