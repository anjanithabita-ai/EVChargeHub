<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\ChargingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StationReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OperatorDashboardController;
use App\Http\Controllers\OperatorController;
use App\Models\Notification;


// =====================================================
// HALAMAN UTAMA
// =====================================================

Route::get('/', function () {
    return view('welcome');
})->name('home');


// =====================================================
// AUTHENTICATION
// =====================================================

// Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Halaman Register
Route::get('/register', [RegisterController::class, 'showRegister'])
    ->name('register');

// Proses Register
Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.process');


// =====================================================
// FORGOT & RESET PASSWORD
// =====================================================

// Halaman Lupa Password
Route::get(
    '/forgot-password',
    [ForgotPasswordController::class, 'showForgotPassword']
)->name('password.request');

// Kirim Link Reset Password
Route::post(
    '/forgot-password',
    [ForgotPasswordController::class, 'sendResetLink']
)->name('password.email');

// Halaman Reset Password
Route::get(
    '/reset-password/{token}',
    [ResetPasswordController::class, 'showResetPassword']
)->name('password.reset');

// Proses Reset Password
Route::post(
    '/reset-password',
    [ResetPasswordController::class, 'resetPassword']
)->name('password.update');


// =====================================================
// ADMIN
// =====================================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'index']
    )->name('admin.dashboard');

});


// =====================================================
// USER / PENGEMUDI
// =====================================================

Route::middleware(['auth', 'role:user'])->group(function () {

    // -------------------------------------------------
    // DASHBOARD USER
    // -------------------------------------------------

    Route::get('/user/dashboard', function () {

        $userId = auth()->user()->id_user;

        // Ambil maksimal 5 notifikasi terbaru
        $notifications = Notification::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Hitung notifikasi yang belum dibaca
        $unreadNotifications = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        return view(
            'user.dashboard',
            compact(
                'notifications',
                'unreadNotifications'
            )
        );

    })->name('user.dashboard');


    // -------------------------------------------------
    // KENDARAAN
    // -------------------------------------------------

    Route::resource(
        '/user/vehicles',
        VehicleController::class
    )->names('vehicles');


    // -------------------------------------------------
    // PROFILE USER
    // -------------------------------------------------

    Route::get(
        '/user/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::put(
        '/user/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::post(
        '/user/profile/photo',
        [ProfileController::class, 'updatePhoto']
    )->name('profile.photo.update');


    Route::get('/profile', function () {

        $user = Auth::user();

        return view(
            'user.profile',
            compact('user')
        );

    })->name('profile');


    // -------------------------------------------------
    // CHARGING STATION
    // -------------------------------------------------

    Route::get(
        '/user/stations',
        [StationController::class, 'index']
    )->name('stations.index');

    Route::get(
        '/user/stations/{id}',
        [StationController::class, 'show']
    )->name('stations.show');


    // -------------------------------------------------
    // RATING & REVIEW STATION
    // -------------------------------------------------

    Route::post(
        '/user/stations/{id_station}/reviews',
        [StationReviewController::class, 'store']
    )->name('station.reviews.store');


    // -------------------------------------------------
    // CHARGING
    // -------------------------------------------------

    Route::get(
        '/user/charging/{charger}/create',
        [ChargingController::class, 'create']
    )->name('charging.create');

    Route::post(
        '/user/charging/{charger}/start',
        [ChargingController::class, 'start']
    )->name('charging.start');

    Route::get(
        '/user/charging/{session}/monitor',
        [ChargingController::class, 'monitor']
    )->name('charging.monitor');

    Route::post(
        '/user/charging/{session}/stop',
        [ChargingController::class, 'stop']
    )->name('charging.stop');

    Route::post(
        '/user/charging/{session}/cancel',
        [ChargingController::class, 'cancel']
    )->name('charging.cancel');

    Route::get(
        '/user/history',
        [ChargingController::class, 'history']
    )->name('charging.history');


    // -------------------------------------------------
    // PEMBAYARAN
    // -------------------------------------------------

    Route::get(
        '/user/payment/{session}/create',
        [PaymentController::class, 'create']
    )->name('payment.create');

    Route::post(
        '/user/payment/{session}/process',
        [PaymentController::class, 'process']
    )->name('payment.process');

    Route::get(
        '/user/payment/{payment}/verify',
        [PaymentController::class, 'verify']
    )->name('payment.verify');

    Route::post(
        '/user/payment/{payment}/confirm',
        [PaymentController::class, 'confirm']
    )->name('payment.confirm');

    Route::get(
        '/user/payment/{payment}/status',
        [PaymentController::class, 'status']
    )->name('payment.status');

    Route::get(
        '/user/payment/{payment}/waiting',
        [PaymentController::class, 'waiting']
    )->name('payment.waiting');

    Route::post(
        '/user/payment/{payment}/fail',
        [PaymentController::class, 'fail']
    )->name('payment.fail');

    Route::post(
        '/user/payment/{payment}/complete',
        [PaymentController::class, 'complete']
    )->name('payment.complete');

    Route::get(
        '/user/payment/{payment}/invoice',
        [PaymentController::class, 'invoice']
    )->name('payment.invoice');


    // -------------------------------------------------
    // NOTIFICATIONS
    // -------------------------------------------------

    Route::get('/user/notifications', function () {

        $userId = auth()->user()->id_user;

        $notifications = Notification::where('user_id', $userId)
            ->latest()
            ->get();

        return view(
            'user.notification.index',
            compact('notifications')
        );

    })->name('notifications.index');


    // Tandai semua notifikasi sebagai dibaca
    Route::post('/user/notifications/read', function () {

        Notification::where(
            'user_id',
            auth()->user()->id_user
        )
        ->where('is_read', false)
        ->update([
            'is_read' => true
        ]);

        return response()->json([
            'success' => true
        ]);

    })->name('notifications.read');


    // Tandai satu notifikasi sebagai dibaca
    Route::post(
        '/user/notifications/{notification}/read',
        [NotificationController::class, 'read']
    )->name('notifications.read.one');

});


// =====================================================
// OPERATOR
// =====================================================
// PENTING:
// Group Operator berada DI LUAR group role:user.
// Jadi middleware hanya:
// auth
// role:operator

Route::middleware(['auth', 'role:operator'])->group(function () {

    // -------------------------------------------------
    // 48. LOGIN OPERATOR
    // -------------------------------------------------
    // Login Operator menggunakan sistem login yang sama.
    // AuthController akan mengarahkan role operator
    // ke operator.dashboard.


    // -------------------------------------------------
    // 49. KELOLA PROFIL OPERATOR
    // -------------------------------------------------

    Route::get(
        '/operator/profile',
        [OperatorController::class, 'profile']
    )->name('operator.profile');

    Route::put(
        '/operator/profile',
        [OperatorController::class, 'updateProfile']
    )->name('operator.profile.update');


    // -------------------------------------------------
    // DASHBOARD OPERATOR
    // -------------------------------------------------

    Route::get(
        '/operator/dashboard',
        [OperatorDashboardController::class, 'index']
    )->name('operator.dashboard');


    // -------------------------------------------------
    // 50. LIHAT CHARGING STATION
    // -------------------------------------------------

    Route::get(
        '/operator/stations',
        [OperatorController::class, 'stations']
    )->name('operator.stations');


    // -------------------------------------------------
    // 51. LIHAT DATA CHARGER
    // -------------------------------------------------

    Route::get(
        '/operator/chargers',
        [OperatorController::class, 'chargers']
    )->name('operator.chargers');

    
    // -------------------------------------------------
    // 52. MONITOR STATUS CHARGER
    // -------------------------------------------------

    Route::get(
        '/operator/charger-status',
        [OperatorController::class, 'chargerStatus']
    )->name('operator.charger-status');


    // -------------------------------------------------
    // 54. UPDATE STATUS CHARGER
    // -------------------------------------------------

    Route::patch(
        '/operator/chargers/{charger}/status',
        [OperatorController::class, 'updateChargerStatus']
    )->name('operator.chargers.status');


    // -------------------------------------------------
    // 53. MONITOR SESI CHARGING
    // -------------------------------------------------

    Route::get(
        '/operator/sessions',
        [OperatorController::class, 'sessions']
    )->name('operator.sessions');


    // -------------------------------------------------
    // 56. LIHAT RIWAYAT SESI CHARGING
    // -------------------------------------------------

    Route::get(
        '/operator/history',
        [OperatorController::class, 'history']
    )->name('operator.history');


    // -------------------------------------------------
    // 57. LIHAT LAPORAN PENGGUNAAN CHARGER
    // -------------------------------------------------

    Route::get(
        '/operator/report',
        [OperatorController::class, 'report']
    )->name('operator.report');

});


// =====================================================
// SELESAI
// =====================================================