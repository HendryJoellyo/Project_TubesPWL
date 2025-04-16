<?php

use App\Http\Controllers\KetuaProdiProfileController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DosenProfileController;
use App\Http\Controllers\TataUsahaProfileController;
use App\Http\Controllers\ManagerProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('kaprodi')->name('kaprodi.')->group(function () {
    Route::get('/', [KetuaProdiProfileController::class, 'index'])->name('dashboard');
    Route::get('/create', [KetuaProdiProfileController::class, 'create'])->name('create');
    Route::post('/store', [KetuaProdiProfileController::class, 'store'])->name('store');
    Route::get('/edit/{nik}', [KetuaProdiProfileController::class, 'edit'])->name('edit');
    Route::put('/{nik}', [KetuaProdiProfileController::class, 'update'])->name('update');
    Route::delete('/delete/{nik}', [KetuaProdiProfileController::class, 'destroy'])->name('destroy');
});

// CRUD Prodi
Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');



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


// CRUD Mahasiswa
Route::get('/Mahasiswa', [MahasiswaProfileController::class, 'index'])->name('mahasiswa.index');
Route::get('/Mahasiswa/create', [MahasiswaProfileController::class, 'create'])->name('mahasiswa.create');
Route::post('/Mahasiswa/create', [MahasiswaProfileController::class, 'store'])->name('mahasiswa.store');
Route::get('/Mahasiswa/{nrp}/edit', [MahasiswaProfileController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/Mahasiswa/{nrp}', [MahasiswaProfileController::class, 'update'])->name('mahasiswa.update');
Route::delete('/Mahasiswa/{nrp}', [MahasiswaProfileController::class, 'destroy'])->name('mahasiswa.destroy');


use App\Http\Controllers\SuratController;

Route::middleware(['auth'])->group(function () {
    Route::resource('surat', SuratController::class)->except(['edit', 'update']);
});

Route::middleware(['role:1'])->group(function() {
    // CRUD Dosen
    Route::get('/dosen', [DosenProfileController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create', [DosenProfileController::class, 'create'])->name('dosen.create');
    Route::post('/dosen/create', [DosenProfileController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{nik}/edit', [DosenProfileController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{nik}', [DosenProfileController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{nik}', [DosenProfileController::class, 'destroy'])->name('dosen.destroy');
});


use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\PengajuanSuratController;

// Route untuk Dashboard Mahasiswa
Route::get('/mahasiswa/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('mahasiswa.dashboard'); // Nama route harus sesuai dengan yang digunakan di view

// Route untuk Pengajuan Surat
Route::middleware(['auth'])->prefix('mahasiswa')->name('mahasiswa.')->group(function() {
    Route::get('/pengajuan-surat', [PengajuanSuratController::class, 'index'])->name('pengajuan_surat.index');
    Route::get('/pengajuan-surat/create', [PengajuanSuratController::class, 'create'])->name('pengajuan_surat.create');
    Route::post('/pengajuan-surat', [PengajuanSuratController::class, 'store'])->name('pengajuan_surat.store');
    Route::delete('/pengajuan-surat/{id}', [PengajuanSuratController::class, 'destroy'])->name('pengajuan_surat.destroy');
});


require __DIR__.'/auth.php';
