<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);

// Guest Routes
Route::middleware('role:guest')->group(function () {
  Route::get('login', [LoginController::class, 'index'])->name('login');
  Route::post('login', [LoginController::class, 'login'])->name('auth.login');

  Route::get('register', [RegisterController::class, 'index'])->name('register');
  Route::post('register', [RegisterController::class, 'register'])->name('auth.register');

  Route::get('logout', [UserController::class, 'logout'])->name('logout')->withoutMiddleware('role:guest');
});


// Admin Routes
Route::middleware(['role:admin'])->group(function () {
  Route::get('admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Customer Routes
Route::middleware(['role:customer'])->group(function () {
  Route::get('/dashboard', [UserController::class, 'customerDashboard'])->name('customer.dashboard');
  Route::get('profile/{id}', [UserController::class, 'customerProfile'])->name('customer.profile');
});

// Tailor Routes
Route::middleware(['role:tailor'])->group(function () {
  Route::get('tailor/dashboard', [UserController::class, 'tailorDashboard'])->name('tailor.dashboard');
});

// multiple roles
Route::middleware(['role:customer,tailor'])->group(function () {
  Route::get('/default', [UserController::class, 'defaultDashboard'])->name('default.dashboard');
});