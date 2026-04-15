<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ItemController::class, 'index'])->name('home');
Route::get('/item/{item}', [ItemController::class, 'show'])->name('items.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes for all Authenticated Users (Profile & Selling)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post Item routes
    Route::get('/post-item', [ItemController::class, 'create'])->name('items.create');
    Route::post('/post-item', [ItemController::class, 'store'])->name('items.store');
    
    // Seller Management Routes (NEW)
    Route::get('/seller/dashboard', [ItemController::class, 'dashboard'])->name('seller.dashboard');
    Route::get('/seller/item/{item}/edit', [ItemController::class, 'edit'])->name('seller.items.edit');
    Route::put('/seller/item/{item}', [ItemController::class, 'update'])->name('seller.items.update');
    Route::delete('/seller/item/{item}', [ItemController::class, 'destroy'])->name('seller.items.destroy');
    Route::patch('/seller/item/{item}/toggle-status', [ItemController::class, 'toggleStatus'])->name('seller.items.toggle-status');
});

// Admin Only Routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/item/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
});

require __DIR__.'/auth.php';