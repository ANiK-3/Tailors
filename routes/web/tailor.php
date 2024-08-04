<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TailorController;
use App\Http\Controllers\RequestController;

//  Tailor Routes
Route::middleware(['role:Tailor'])->group(function () {

  Route::controller(TailorController::class)->group(function () {
    Route::get('dashboard', 'tailorDashboard')->name('tailor.dashboard');
  });

  Route::get('/manage-request/{id}', [RequestController::class, 'showRequest'])->name('request.show')->middleware('role:Tailor');
  Route::post('/accept-request/{id}', [RequestController::class, 'acceptRequest'])->name('request.accept')->middleware('role:Tailor');
  Route::post('/decline-request/{id}', [RequestController::class, 'declineRequest'])->name('request.decline')->middleware('role:Tailor');

  // Route::get('response_hire/{id}', [HireController::class, 'responseHire'])->name('response_hire');
});