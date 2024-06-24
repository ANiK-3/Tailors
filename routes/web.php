<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('home');

Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');
Route::get('dashboard', [LoginController::class, 'dashboardPage'])->name('dashboard');

Route::get('logout', [UserController::class, 'logout'])->name('logout');


Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
