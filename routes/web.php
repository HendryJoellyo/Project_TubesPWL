<?php

use App\Http\Controllers\KetuaProdiProfileController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DosenProfileController;
use App\Http\Controllers\TataUsahaProfileController;
use App\Http\Controllers\ManagerProfileController;
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





// CRUD Ketua Prodi
Route::get('/dashboard', [KetuaProdiProfileController::class, 'index'])->name('dashboard');
Route::get('/create', [KetuaProdiProfileController::class, 'create'])->name('create');
Route::post('/kaprodi/store', [KetuaProdiProfileController::class, 'store'])->name('store');


Route::get('/kaprodi/edit/{nik}', [KetuaProdiProfileController::class, 'edit'])->name('edit');
Route::put('/kaprodi/{nik}', [KetuaProdiProfileController::class, 'update'])->name('kaprodi.update');

Route::delete('/kaprodi/delete/{nik}', [KetuaProdiProfileController::class, 'destroy'])->name('delete');
Route::get('/kaprodi/create', [KetuaProdiProfileController::class, 'create'])->name('kaprodi.create');

// CRUD Prodi
Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');


// CRUD Dosen
Route::get('/dosen', [DosenProfileController::class, 'index'])->name('dosen.index');
Route::get('/dosen/create', [DosenProfileController::class, 'create'])->name('dosen.create');
Route::post('/dosen/create', [DosenProfileController::class, 'store'])->name('dosen.store');
Route::get('/dosen/{nik}/edit', [DosenProfileController::class, 'edit'])->name('dosen.edit');
Route::put('/dosen/{nik}', [DosenProfileController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{nik}', [DosenProfileController::class, 'destroy'])->name('dosen.destroy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('dosen', DosenProfileController::class);
});

// CRUD Tata Usaha
Route::get('/TataUsaha', [TataUsahaProfileController::class, 'index'])->name('tata_usaha.index');
Route::get('/TataUsaha/create', [TataUsahaProfileController::class, 'create'])->name('tata_usaha.create');
Route::post('/TataUsaha/create', [TataUsahaProfileController::class, 'store'])->name('tata_usaha.store');
Route::get('/TataUsaha/{nik}/edit', [TataUsahaProfileController::class, 'edit'])->name('tata_usaha.edit');
Route::put('/TataUsaha/{nik}', [TataUsahaProfileController::class, 'update'])->name('tata_usaha.update');
Route::delete('/TataUsaha/{nik}', [TataUsahaProfileController::class, 'destroy'])->name('tata_usaha.destroy');

// CRUD Manager Operasional
Route::get('/ManagerOperasional', [ManagerProfileController::class, 'index'])->name('manager.index');
Route::get('/ManagerOperasional/create', [ManagerProfileController::class, 'create'])->name('manager.create');
Route::post('/ManagerOperasional/create', [ManagerProfileController::class, 'store'])->name('manager.store');
Route::get('/ManagerOperasional/{nik}/edit', [ManagerProfileController::class, 'edit'])->name('manager.edit');
Route::put('/ManagerOperasional/{nik}', [ManagerProfileController::class, 'update'])->name('manager.update');
Route::delete('/ManagerOperasional/{nik}', [ManagerProfileController::class, 'destroy'])->name('manager.destroy');

require __DIR__.'/auth.php';
