<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth');
Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->middleware('auth');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

Route::post('/register-admin', [RegisteredUserController::class, 'storeAdmin'])->withoutMiddleware('auth');

require __DIR__.'/auth.php';
