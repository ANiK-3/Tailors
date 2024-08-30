<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RequestController;

//  Customer Routes
Route::middleware(['role:Customer'])->group(function () {

  Route::controller(CustomerController::class)->group(function () {
    Route::get('home', 'customerDashboard')->name('customer.dashboard');
    Route::get('profile', 'profile')->name('customer.profile');
    Route::get('profile/update', 'showUpdateProfile')->name('customer.show_update_profile');
    Route::post('profile/update', 'updateProfile')->name('customer.update_profile');
    Route::get('profile/password', 'showUpdatePassword')->name('password.show_update');
    Route::post('profile/password/validate-current', 'validateCurrentPassword')->name('password.validateCurrent');
    Route::post('profile/password/update', 'updatePassword')->name('password.update');

    // Send notification to tailor
    // Route::post('send-hire-notification', [RequestController::class, 'sendHireNotification'])->name('send_hire_notification')->middleware('check.hire.timing', 'role:Customer');
    Route::post('send-hire-notification', [RequestController::class, 'sendHireNotification'])->name('send_hire_notification')->middleware('role:Customer');


    Route::get('/fabric-details/{requestId}', function ($requestId) {
      return view('request.fabric_details', compact('requestId'));
    })->name('fabric_details');
    // Route::post('/fabric-details', [FabricController::class, 'store']);


    //DELETE
    // Route::get('tailor/hire/{id}', [HireController::class, 'send'])->name('hire.send');
    // Route::post('appointment', [AppointmentController::class, 'create'])->name('appointment.create');
    // Route::post('/appointments/{appointment}', [AppointmentController::class, 'updateStatus'])->name('appointment.updateStatus');
  });
});