<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\AdminController;

// Admin Routes

Route::middleware('role:Admin')->group(function () {

  Route::get('/users/user', [UserController::class, 'getUser'])->name('users.get');

  Route::get('/admin/manage-shop', [AdminController::class, 'manageShop'])->name('admin.manage_shop');
  Route::get('/admin/manage-request', [AdminController::class, 'manageRequest'])->name('admin.show_manage_request');
  Route::get('/admin/create-shop', [AdminController::class, 'showCreateShop'])->name('admin.show_create_shop');
  Route::post('/admin/create-shop', [AdminController::class, 'createShop'])->name('admin.create_shop');

  Route::get('tailor/show/{id}', [AdminController::class, 'showTailor'])->name('admin.show_tailor_info');
  Route::post('admin/accept-tailor-request/{id}', [AdminController::class, 'acceptRequest'])->name('admin.accept_tailor_request');
  Route::post('admin/decline-tailor-request{id}', [AdminController::class, 'declineRequest'])->name('admin.decline_tailor_request');

   Route::resource('users', UserController::class);
  Route::resource('role', RoleController::class);
  Route::resource('admin', AdminController::class);
});
