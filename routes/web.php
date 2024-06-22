<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);
