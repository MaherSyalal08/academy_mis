<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemoController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('./layouts/starter');
});

Route::get('/1', function () {
    return view('./demo/file1');
});

// Route::get('/2', function () {
//     return view('./demo/file2');
// });

Route::get('/2', [DemoController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
