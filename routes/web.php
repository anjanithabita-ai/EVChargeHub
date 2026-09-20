<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\ChargingController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])
    ->name('password.update');


Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::resource('/user/vehicles', VehicleController::class)
        ->names('vehicles');

    Route::get('/user/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/user/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/user/stations', [StationController::class, 'index'])
        ->name('stations.index');

    Route::get('/user/stations/{id}', [StationController::class, 'show'])
        ->name('stations.show');

    Route::get('/user/charging/{charger}/create', [ChargingController::class, 'create'])
        ->name('charging.create');

    Route::post('/user/charging/{charger}/start', [ChargingController::class, 'start'])
        ->name('charging.start');

    Route::get('/user/charging/{session}/monitor', [ChargingController::class, 'monitor'])
        ->name('charging.monitor');

    Route::post('/user/charging/{session}/stop', [ChargingController::class, 'stop'])
        ->name('charging.stop');

    Route::post('/user/charging/{session}/cancel', [ChargingController::class, 'cancel'])
        ->name('charging.cancel');

    Route::get('/user/payment/{session}/create', [PaymentController::class, 'create'])
        ->name('payment.create');

    Route::post('/user/payment/{session}/process', [PaymentController::class, 'process'])
        ->name('payment.process');

    Route::get('/user/payment/{payment}/verify', [PaymentController::class, 'verify'])
        ->name('payment.verify');

    Route::post('/user/payment/{payment}/confirm', [PaymentController::class, 'confirm'])
        ->name('payment.confirm');

    Route::get('/user/payment/{payment}/status', [PaymentController::class, 'status'])
        ->name('payment.status');

    Route::get('/user/payment/{payment}/invoice', [PaymentController::class, 'invoice'])
        ->name('payment.invoice');

    Route::get('/user/notifications', function () {
        return view('notifications.index');
    })->name('notifications.index');

});
