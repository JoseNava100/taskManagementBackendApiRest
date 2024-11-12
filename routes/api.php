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

    /**
     * Run HTTP Request User.
     */
    
Route::get('/user', [RoleController::class, 'index']);
Route::post('/user', [RoleController::class, 'store']);
Route::get('/user/{user}', [RoleController::class, 'show']);
Route::patch('/user/{user}', [RoleController::class, 'edit']);
Route::put('/user/{user}', [RoleController::class, 'update']);
Route::delete('/user/{user}', [RoleController::class, 'destroy']);

    /**
     * Run HTTP Request User Session.
     */
    
Route::get('/session/user', [RoleController::class, 'index']);
Route::post('/session/user', [RoleController::class, 'store']);
Route::get('/session/user/{user}', [RoleController::class, 'show']);
Route::patch('/session/user/{user}', [RoleController::class, 'edit']);
Route::put('/session/user/{user}', [RoleController::class, 'update']);
Route::delete('/session/user/{user}', [RoleController::class, 'destroy']);