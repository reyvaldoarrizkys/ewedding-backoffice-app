<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute yang bisa diakses oleh Admin & Staff
    Route::resource('clients', ClientController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('information', InformationController::class);
    
    // Rute Khusus Admin
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('financial-reports', FinancialReportController::class);
        Route::resource('users', UserController::class);
    });
});
