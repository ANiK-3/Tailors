<?php

use App\Events\SendHireNotification;
use App\Events\SendNotification;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TailorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use App\Models\Tailor;
use App\Models\User;


// NOTIFICATIONS
Route::middleware('auth')->group(function () {
  Route::get('/notifications', [NotificationController::class, 'index']);
  Route::post('/notifications/store', [NotificationController::class, 'store']);
  Route::post('/notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead']);
});
//

// routes/web.php
// Route::post('send-hire-notification', [RequestController::class, 'sendHireNotification'])->name('send_hire_notification')->middleware('check.hire.timing', 'role:Customer');
Route::post('send-hire-notification', [RequestController::class, 'sendHireNotification'])->name('send_hire_notification')->middleware('role:Customer');
Route::get('/manage-request/{id}', [RequestController::class, 'showRequest'])->name('request.show')->middleware('role:Tailor');
Route::post('/accept-request/{id}', [RequestController::class, 'acceptRequest'])->name('request.accept')->middleware('role:Tailor');
Route::post('/decline-request/{id}', [RequestController::class, 'declineRequest'])->name('request.decline')->middleware('role:Tailor');
Route::get('/fabric-details/{requestId}', function ($requestId) {
  return view('request.fabric_details', compact('requestId'));
})->name('fabric_details')->middleware('role:Customer');
// Route::post('/fabric-details', [FabricController::class, 'store']);


Route::get('/', function () {
  $tailors = Tailor::with('user')->get();
  return view('index', compact('tailors'));
})->name('home');

Route::get('about_us', function () {
  return view('about_us');
})->name('about_us');

// OTP Route
Route::controller(OtpController::class)->group(function () {
  Route::get('otp/login', 'index')->name('otp.login');
  Route::post('otp/generate', 'generate')->name('otp.generate');
  Route::get('otp/verification', 'verification')->name('otp.verification');
  Route::post('otp/login', 'loginWithOtp')->name('otp.getLogin');
  Route::post('otp/resend', 'resendOtp')->name('otp.resend');
});

// Guest Routes
Route::middleware('role:Guest')->group(function () {
  Route::get('login', [LoginController::class, 'index'])->name('login');
  Route::post('login', [LoginController::class, 'login'])->name('auth.login');

  Route::get('register', [RegisterController::class, 'index'])->name('register');
  Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
});

// Logout route
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['role:Admin'])->group(function () {
  Route::resource('user', UserController::class);
  Route::resource('role', RoleController::class);
  Route::resource('admin', AdminController::class);
});

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


    // Route::get('tailor/hire/{id}', [HireController::class, 'send'])->name('hire.send');
    // Route::post('appointment', [AppointmentController::class, 'create'])->name('appointment.create');
    // Route::post('/appointments/{appointment}', [AppointmentController::class, 'updateStatus'])->name('appointment.updateStatus');
  });
});

Route::get('tailor/{id}', [TailorController::class, 'show'])->name('tailor.show');

//  Tailor Routes
Route::middleware(['role:Tailor'])->group(function () {
  Route::controller(TailorController::class)->group(function () {
    Route::get('dashboard', 'tailorDashboard')->name('tailor.dashboard');
  });

  // Route::get('response_hire/{id}', [HireController::class, 'responseHire'])->name('response_hire');
});

// Global Routes
Route::middleware('role:Customer,Tailor')->group(function () {
  Route::get('measurements/{user}', [MeasurementController::class, 'show'])->name('measurements.show');
  Route::post('measurements/{user}', [MeasurementController::class, 'store'])->name('measurements.store');
});

//  Admin && Customer/Tailor Routes
Route::middleware(['role:Customer,Tailor'])->group(function () {
  Route::get('/default', [UserController::class, 'defaultDashboard'])->name('default.dashboard');
});
