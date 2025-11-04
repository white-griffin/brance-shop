<?php

use App\Http\Controllers\Web\Admin\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ADMIN_AUTHENTICATION Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ADMIN_AUTHENTICATION routes for your application. These
| routes are loaded by the RouteServiceProvider. Make something great!
|
*/
Route::controller(AuthController::class)->group( function () {

    Route::view('/login','auth.admin.login')->name('admin.auth.login.form');
    Route::post('/login','login')->name('admin.auth.login.store');
    Route::get('/logout', 'logout')->name('admin.auth.logout');

});




