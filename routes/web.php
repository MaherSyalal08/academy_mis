<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.starter');
});

Route::get('/1', function () {
    return view('demo.file1');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware(['role:1'])->group(function(){
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosenList');
        Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosenCreate');
        Route::post('/dosen/create', [DosenController::class, 'store'])->name('dosenStore');
        Route::get('/dosen/edit/{dosen}', [DosenController::class, 'edit'])->name('dosenEdit');
        Route::put('/dosen/edit/{dosen}}', [DosenController::class, 'update'])->name('dosenUpdate');
        Route::delete('/dosen/delete/{dosen}', [DosenController::class, 'destroy'])->name('dosenDelete');
    });
});

Route::get('/2', [DemoController::class, 'index']);

Route::get('/forms', function () {
    return view('layouts.forms');
});

// Dosen Routes
// Route::get('/dosen', [DosenController::class, 'index'])->name('dosenList');
// Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosenCreate');
// Route::post('/dosen/create', [DosenController::class, 'store'])->name('dosenStore');
// Route::get('/dosen/edit/{dosen}', [DosenController::class, 'edit'])->name('dosenEdit');
// Route::put('/dosen/edit/{dosen}}', [DosenController::class, 'update'])->name('dosenUpdate');
// Route::delete('/dosen/delete/{dosen}', [DosenController::class, 'destroy'])->name('dosenDelete');


// Mahasiwa Routes
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswaList');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswaCreate');
Route::post('/mahasiswa/create', [MahasiswaController::class, 'store'])->name('mahasiswaStore');
Route::get('/mhs/edit/{nrp}', [MahasiswaController::class, 'edit'])->name('mahasiswaEdit');
Route::put('/mhs/edit/{nrp}', [MahasiswaController::class, 'update'])->name('mahasiswaUpdate');
Route::delete('/mhs/delete/{nrp}', [MahasiswaController::class, 'destroy'])->name('mahasiswaDelete');
Route::get('/mhs/detail/{nrp}', [MahasiswaController::class, 'show'])->name('mahasiswaDetail');

Route::get('/', function () {
    return view('layouts.starter');
})->name('dashboard');



require __DIR__.'/auth.php';
