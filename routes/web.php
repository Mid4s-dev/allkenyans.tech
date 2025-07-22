<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

// Public routes
Route::get('/', [BlockController::class, 'index'])->name('home');
Route::post('/block/twitter-account', [BlockController::class, 'store'])->name('block.store');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth routes
Route::get('/auth/redirect/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/callback/google', [GoogleController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/blocked', [DashboardController::class, 'blockedAccounts'])->name('dashboard.blocked');
    Route::delete('/dashboard/blocked/{blocked}', [DashboardController::class, 'unblock'])->name('dashboard.unblock');
    
    Route::get('/report', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/submit', [ReportController::class, 'store'])->name('report.store');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
});
