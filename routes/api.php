<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::post('/login', [LoginController::class, 'store']);

Route::post('/login/verify', [LoginController::class, 'verify']);



Route::middleware(['auth:sanctum'])->group(function () {


    Route::get('/driver', [DriverController::class, 'index']);

    Route::post('/driver', [DriverController::class, 'update']);

    Route::get('/user', function () {

        return  auth()->user();
    });

    Route::get('/');
});
