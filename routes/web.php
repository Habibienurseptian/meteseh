<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotDirectController;

use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Guest\BookingController as GuestBookingController;
use App\Http\Controllers\Guest\MaktabController as GuestMaktabController;

use App\Http\Controllers\Staf\BookingController as StafBookingController;
use App\Http\Controllers\Staf\MaktabController as StafMaktabController;
use App\Http\Controllers\Staf\StafController as StafStafController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaktabController;


/**
 * ===========================
 * Route untuk pengguna umum
 * ===========================
 */
Route::name('guest.')->group(function () {
    // Halaman utama (dashboard atau halaman welcome)
    Route::get('/', [DashboardController::class, 'index'])->name('welcome');
    Route::get('/booking/{id}', [DashboardController::class, 'show'])->name('detail');
    Route::get('/maktab/{id}', [MaktabController::class, 'show'])->name('maktab');
});



Route::get('/forbidden', function () {
    return response()->view('errors.403', [], 403);
})->name('forbidden');

/**
 * ===========================
 * Route TAMU LOGIN (role: tamu)
 * ===========================
 */
Route::middleware(['auth', 'role:tamu'])->prefix('tamu')->name('tamu.')->group(function () {
    Route::get('/dashboard', [GuestController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [GuestController::class, 'index'])->name('index');

    // Route statis harus di atas
    Route::get('/bookings/create', [GuestController::class, 'create'])->name('bookings.create');

    Route::post('/bookings', [GuestController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [GuestController::class, 'show'])->name('bookings.show');
    Route::get('/maktab/{id}', [GuestMaktabController::class, 'show'])->name('maktab.show');
    Route::get('/bookings/{booking_code}/edit', [GuestController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking_code}', [GuestController::class, 'update'])->name('bookings.update');
});


/**
 * ===========================
 * Route untuk STAF
 * ===========================
 */
Route::middleware(['auth', 'role:staf'])->prefix('staf')->name('staf.')->group(function () {
    Route::get('/', [StafStafController::class, 'index'])->name('index');

    Route::resource('bookings', StafBookingController::class);
    Route::resource('maktab', StafMaktabController::class);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

/**
 * ===========================
 * Auth
 * ===========================
 */
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password-direct', [ForgotDirectController::class, 'showForm'])->name('password.forgot.direct');
Route::post('/forgot-password-direct', [ForgotDirectController::class, 'resetPassword'])->name('password.reset.direct');
