<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeasurementController;
use App\Models\TailorType;


Route::get('/', function () {
  $tailorTypes = TailorType::get();
  return view('index', compact('tailorTypes'));
})->name('home');

Route::get('/tailors/tailor', [CustomerController::class, 'getTailor'])->name('tailor.get');

Route::get('about_us', function () {
  return view('about_us');
})->name('about_us');

// Global Routes
Route::middleware('role:Customer,Tailor')->group(function () {
  Route::get('measurements/{user}', [MeasurementController::class, 'show'])->name('measurements.show');
  Route::post('measurements/{user}', [MeasurementController::class, 'store'])->name('measurements.store');
});

//  Admin && Customer/Tailor Routes
Route::middleware(['role:Customer,Tailor'])->group(function () {
  Route::get('/default', [UserController::class, 'defaultDashboard'])->name('default.dashboard');
});
