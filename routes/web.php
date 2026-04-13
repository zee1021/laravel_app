<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController; // Import your Item Controller
use App\Http\Controllers\AdminController; // Import your Admin Controller
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes for all Authenticated Users (Profile & Selling)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Add your "Post Item" route here
    Route::get('/post-item', [ItemController::class, 'create'])->name('items.create');
});

// Admin Only Routes - Using your custom AdminMiddleware
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/item/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});

require __DIR__.'/auth.php';