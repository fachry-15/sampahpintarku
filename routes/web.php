<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\AccountsControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardControllers;
use App\Http\Controllers\GatewayControllers;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\JadwalPengambilanController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\testingcontrollers;
use App\Http\Controllers\TimeControlController;
use App\Http\Controllers\UsersController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/kirim-whatsapp', [GatewayControllers::class, 'sendMessage']);

//Register Controllers
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
Route::get('auth/google/logout', [GoogleAuthController::class, 'logout'])->name('google.logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardControllers::class, 'index'])->name('dashboard');

    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');

    Route::get('/profile', [AccountsControllers::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AccountsControllers::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AccountsControllers::class, 'destroy'])->name('profile.destroy');

    Route::get('/contact-admin', [ContactController::class, 'index'])->name('contact.index');

    Route::get('/sampah', [JadwalPengambilanController::class, 'index'])->name('sampah.index');
    Route::get('/sampah/{id}/edit', [JadwalPengambilanController::class, 'edit'])->name('sampah.edit');
    Route::patch('/sampah/{id}', [JadwalPengambilanController::class, 'update'])->name('sampah.update');
});

Route::group(['middleware' => ['role:superadmin']], function () {
    // route untuk manajemen user
    Route::get('/user', [UsersController::class, 'index'])->name('user.index');
    Route::get('/user/{id}/edit', [UsersController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}/activate', [UsersController::class, 'activation'])->name('user.activate');
    Route::patch('/user/{id}/update-activation', [UsersController::class, 'updateActivation'])->name('user.updateActivation');
    Route::patch('/user/{id}', [UsersController::class, 'update'])->name('user.update');

    // route untuk manajemen waktuy pengambilan sampah
    Route::get('/controlling', [TimeControlController::class, 'index'])->name('controlling.index');
    Route::put('/controlling/{id}', [TimeControlController::class, 'update'])->name('time.update');
});

Route::group(['middleware' => ['role:petugas_sampah']], function () {});

Route::group(['middleware' => ['role:warga|superadmin']], function () {
    Route::post('/pesan', [PesanController::class, 'store'])->name('pesan.store');
});

require __DIR__ . '/auth.php';
