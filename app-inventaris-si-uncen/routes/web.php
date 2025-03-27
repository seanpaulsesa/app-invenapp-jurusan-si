<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KetuaJurusanController;
use App\Http\Controllers\StafJurusanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KategoriRuanganController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/ketua-jurusan', [KetuaJurusanController::class, 'index']);
Route::get('/staf-jurusan', [StafJurusanController::class, 'index']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('beranda');
    })->name('dashboard');

    Route::get('/beranda', function () {
        return view('beranda');
    })->name('beranda');



    // prefix barang
    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('barang');
        Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/show/{id}', [BarangController::class, 'show'])->name('barang.show');
        Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/update/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::get('/destory/{id}', [BarangController::class, 'destory'])->name('barang.destory');
    });

    // prefix kategori barang
    Route::prefix('kategori-barang')->group(function () {
        Route::get('/', [KategoriBarangController::class, 'index'])->name('kategori-barang');
        Route::get('/create', [KategoriBarangController::class, 'create'])->name('kategori-barang.create');
        Route::post('/store', [KategoriBarangController::class, 'store'])->name('kategori-barang.store');
        Route::get('/edit/{id}', [KategoriBarangController::class, 'edit'])->name('kategori-barang.edit');
        Route::post('/update/{id}', [KategoriBarangController::class, 'update'])->name('kategori-barang.update');
        Route::get('/hapus/{id}', [KategoriBarangController::class, 'hapus'])->name('kategori-barang.hapus');
    });

    // prefix ruangan
    Route::prefix('ruangan')->group(function () {
        Route::get('/', [RuanganController::class, 'index'])->name('ruangan');
        Route::get('/create', [RuanganController::class, 'create'])->name('ruangan.create');
        Route::post('/show', [RuanganController::class, 'show'])->name('ruangan.show');
        Route::post('/store', [RuanganController::class, 'store'])->name('ruangan.store');
        Route::get('/edit/{id}', [RuanganController::class, 'edit'])->name('ruangan.edit');
        Route::post('/update/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
        Route::get('/destroy/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
        Route::get('/hapus/{id}', [RuanganController::class, 'hapus'])->name('ruangan.hapus');
    });

    // prefix kategori ruangan
    Route::prefix('kategori-ruangan')->group(function () {
        Route::get('/', [KategoriRuanganController::class, 'index'])->name('kategori-ruangan');
        Route::get('/create', [KategoriRuanganController::class, 'create'])->name('kategori-ruangan.create');
        Route::post('/store', [KategoriRuanganController::class, 'store'])->name('kategori-ruangan.store');
        Route::get('/edit/{id}', [KategoriRuanganController::class, 'edit'])->name('kategori-ruangan.edit');
        Route::post('/update/{id}', [KategoriRuanganController::class, 'update'])->name('kategori-ruangan.update');
        Route::get('/hapus/{id}', [KategoriRuanganController::class, 'hapus'])->name('kategori-ruangan.hapus');
    });


    
    
    

});

