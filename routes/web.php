<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyEntryController;
use App\Http\Controllers\CustomMetricController;
use App\Http\Controllers\CustomMetricValueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;

// Root redirect
Route::get('/', function () {
    return auth()->check() ? redirect()->route('daily_entries.index') : redirect()->route('login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Password update
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Daily entries routes
    Route::get('/daily-entries', [DailyEntryController::class, 'index'])->name('daily_entries.index');
    Route::get('/daily-entries/create', [DailyEntryController::class, 'create'])->name('daily_entries.create');
    Route::post('/daily-entries', [DailyEntryController::class, 'store'])->name('daily_entries.store');
    Route::get('/daily-entries/{dailyEntry}/edit', [DailyEntryController::class, 'edit'])->name('daily_entries.edit');
    Route::put('/daily-entries/{dailyEntry}', [DailyEntryController::class, 'update'])->name('daily_entries.update');
    Route::delete('/daily-entries/{dailyEntry}', [DailyEntryController::class, 'destroy'])->name('daily_entries.destroy');

    // Custom metrics routes
    Route::get('/custom-metrics', [CustomMetricController::class, 'index'])->name('custom_metrics.index');
    Route::get('/custom-metrics/create', [CustomMetricController::class, 'create'])->name('custom_metrics.create');
    Route::post('/custom-metrics', [CustomMetricController::class, 'store'])->name('custom_metrics.store');
    Route::delete('/custom-metrics/{customMetric}', [CustomMetricController::class, 'destroy'])->name('custom_metrics.destroy');

    // Custom metric values route
    Route::post('/custom-metric-values', [CustomMetricValueController::class, 'store'])->name('custom_metric_values.store');

});
