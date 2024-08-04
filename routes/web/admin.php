<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\AdminController;

// Admin Routes
Route::middleware(['role:Admin'])->group(function () {
  Route::resource('users', UserController::class);
  Route::resource('role', RoleController::class);
  Route::resource('admin', AdminController::class);


  Route::get('/admin/manage-shop', [AdminController::class, 'manageShop'])->name('admin.manage_shop');
  Route::get('/admin/manage-request', [AdminController::class, 'manageRequest'])->name('admin.show_manage_request');
  Route::get('/admin/create-shop', [AdminController::class, 'showCreateShop'])->name('admin.show_create_shop');
  Route::post('/admin/create-shop', [AdminController::class, 'createShop'])->name('admin.create_shop');
});