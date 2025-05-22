<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StatistikController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API UNTUK MENAMPILKAN CHART BARANG PER KATEGORI
Route::get('/chart-barang-per-kategori', [StatistikController::class, 'chartBarangPerKategori'])->name('apichartbarangperkategori');

// API UNTUK MENAMPILKAN CHART RUANGAN PER KATEGORI
Route::get('/chart-ruangan-per-kategori', [StatistikController::class, 'chartRuanganPerKategori'])->name('apichartruanganperkategori');
