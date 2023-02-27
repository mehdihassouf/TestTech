<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;	
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
 

Route::post('login', [JWTAuthController::class, 'login']);
  
Route::group(['middleware' => 'auth.jwt'], function () {
 
    Route::post('logout', [JWTAuthController::class, 'logout']);
  
});

Route::resource('/project', ProjectController::class);
Route::resource('/task', TaskController::class);