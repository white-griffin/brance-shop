<?php

use App\Http\Controllers\Api\Auth\User\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticationController::class)->group(function (){
    Route::post('/login','loginUser');
    Route::post('/check_code','checkCode');
    Route::get('/logout','logOut')->middleware('auth:sanctum');
    Route::post('/update-device-token','updateDeviceToken')->middleware('auth:sanctum');
    Route::post('/national-code-auth','nationalCodeAuth')->middleware('auth:sanctum');
});
