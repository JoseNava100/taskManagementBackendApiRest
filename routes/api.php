<?php

use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserSessionController;
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
    
Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::patch('/user/{user}', [UserController::class, 'edit']);
Route::put('/user/{user}', [UserController::class, 'update']);
Route::delete('/user/{user}', [UserController::class, 'destroy']);

    /**
     * Run HTTP Request User Session.
     */
    
Route::post('/login', [UserSessionController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function(){
    
    Route::get('/profile', [UserSessionController::class, 'profile']);
    Route::post('/logout', [UserSessionController::class, 'logout']);

});