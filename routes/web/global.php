<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;



Route::middleware('auth')->group(function () {

  Route::get('/users/user', [UserController::class, 'getUser'])->name('user.get');

  // NOTIFICATIONS
  Route::get('/notifications', [NotificationController::class, 'index']);
  Route::post('/notifications/store', [NotificationController::class, 'store']);
  Route::post('/notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead']);
});