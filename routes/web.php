<?php

use App\Http\Controllers\KetuaProdiProfileController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('tata_usaha.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





//Tata usaha CRUD Ketua Prodi
Route::get('/dashboard', [KetuaProdiProfileController::class, 'index'])->name('dashboard');
Route::get('/create', [KetuaProdiProfileController::class, 'create'])->name('create');
Route::post('/store', [KetuaProdiProfileController::class, 'store'])->name('store');
Route::get('/kaprodi/edit/{nik}', [KetuaProdiProfileController::class, 'edit'])->name('edit');
Route::put('/kaprodi/{nik}', [KetuaProdiProfileController::class, 'update'])->name('kaprodi.update');

Route::delete('/kaprodi/delete/{nik}', [KetuaProdiProfileController::class, 'destroy'])->name('delete');
Route::get('/kaprodi/create', [KetuaProdiProfileController::class, 'create'])->name('kaprodi.create');

//Tata usaha CRUD Prodi
Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');



require __DIR__.'/auth.php';
