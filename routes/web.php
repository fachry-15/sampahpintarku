<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardControllers;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\UsersController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardControllers::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/history', [HistoryController::class, 'index'])->middleware(['auth', 'verified'])->name('history.index');

Route::get('/pesan', [PesanController::class, 'index'])->middleware(['auth', 'verified'])->name('pesan.index');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

//Register Controllers
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
Route::get('auth/google/logout', [GoogleAuthController::class, 'logout'])->name('google.logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/pesan', [PesanController::class, 'store'])->name('pesan.store');

    Route::get('/user', [UsersController::class, 'index'])->name('user.index');
    Route::get('/user/{id}/edit', [UsersController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}/activate', [UsersController::class, 'activation'])->name('user.activate');
    Route::patch('/user/{id}/update-activation', [UsersController::class, 'updateActivation'])->name('user.updateActivation');
    Route::patch('/user/{id}', [UsersController::class, 'update'])->name('user.update');
});

require __DIR__ . '/auth.php';
