<?php

use App\Http\Controllers\Api\RideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaypalController;
use App\Http\Controllers\Api\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth Routes
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('verifyEmail', 'emailVerificationSent');
    Route::post('set-code', 'verifyEmail');
    Route::post('reset-password', 'resetPassword');
});

// Profile Routes
Route::controller(ProfileController::class)->prefix('user')->middleware('auth:api')->group(function() {
    Route::get('show', 'show');
    Route::post('update', 'update');
});

// Ride Process Routes
Route::controller(RideController::class)->prefix('ride')->group(function() {
    Route::post('details', 'rideDetails');
    Route::get('transports', 'transports');
    Route::get('cars', 'getCars');
});

// Paypal Routes
Route::controller(PaypalController::class)->prefix('paypal')->group(function () {
    Route::post('paypal', 'paypal');
    Route::get('success', 'success')->name('success');
    Route::get('cancel', 'cancel')->name('cancel');
});