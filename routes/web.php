<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::view('/', 'index')->name('home');

Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');

Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('auth.register');

// Admin Routes
Route::middleware(['role:admin'])->group(function () {
  Route::get('admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Customer Routes
Route::middleware(['role:customer'])->group(function () {
  Route::get('customer/dashboard', [UserController::class, 'customerDashboard'])->name('customer.dashboard');
});

// Tailor Routes
Route::middleware(['role:tailor'])->group(function () {
  Route::get('tailor/dashboard', [UserController::class, 'tailorDashboard'])->name('tailor.dashboard');
});

// multiple roles
Route::middleware(['role:customer,tailor'])->group(function () {
  Route::get('/default', [UserController::class, 'defaultDashboard'])->name('default.dashboard');
});