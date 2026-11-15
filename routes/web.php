<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\ExerciseLogController;
use App\Http\Controllers\AnalyzerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

// Saari routes jo login ke baghair nahi khul saktin
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    
    // Fitness Modules
    Route::resource('food-logs', FoodLogController::class);
    Route::resource('exercise-logs', ExerciseLogController::class);
    Route::get('/analyzer', [AnalyzerController::class, 'index'])->name('analyzer.index');

    // Breeze Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// LIVE DEPLOYMENT MIGRATION ROUTE (Yeh bina login ke chalega)
Route::get('/run-migrations-secret', function () {
    try {
        Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
            '--no-interaction' => true, // Yeh line Laravel ko force karegi ke sawal na poochay
        ]);
        return 'Migrations and seeding completed successfully! Aap ab login kar sakte hain.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

require __DIR__.'/auth.php';