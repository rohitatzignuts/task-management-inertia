<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('projects')->middleware('auth')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects');
    Route::get('/{project}', [ProjectController::class, 'view'])->name('projects.view');
    Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/{project}/update', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});

Route::prefix('tasks')->middleware('auth')->group(function () {
    Route::get('/{project}', [TaskController::class, 'index'])->name('tasks');
    Route::get('/{task}', [TaskController::class, 'view'])->name('tasks.view');
    Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/{task}/update', [TaskController::class, 'updateStatus'])->name('tasks.update');
    Route::put('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
require __DIR__.'/auth.php';
