<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomMetricController;
use App\Http\Controllers\DailyEntryController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/custom-metrics', [CustomMetricController::class, 'index'])->name('custom-metrics.index');
    Route::get('/custom-metrics/create',[CustomMetricController::class, 'create'])->name('custom-metrics.create');
    Route::post('/custom-metrics', [CustomMetricController::class, 'store'])->name('custom-metrics.store');
    Route::put('/custom-metrics/{metric}', [CustomMetricController::class, 'update'])->name('custom-metrics.update');
    Route::delete('/custom-metrics/{metric}', [CustomMetricController::class, 'destroy'])->name('custom-metrics.destroy');

    Route::get('/daily-entries', [DailyEntryController::class, 'index'])->name('daily-entries.index');
    Route::post('/daily-entries', [DailyEntryController::class, 'store'])->name('daily-entries.store');

    Route::get('/daily-entries/create', [DailyEntryController::class, 'create'])->name('daily-entries.create');
    Route::get('/daily-entries/{entry}/edit', [DailyEntryController::class, 'edit'])->name('daily-entries.edit');

    Route::get('/daily-entries/{entry}', [DailyEntryController::class, 'show'])->name('daily-entries.show');

    Route::put('/daily-entries/{entry}', [DailyEntryController::class, 'update'])->name('daily-entries.update');
    Route::delete('/daily-entries/{entry}', [DailyEntryController::class, 'destroy'])->name('daily-entries.destroy');

});

require __DIR__.'/auth.php';
