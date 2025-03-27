<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KetuaJurusanController;
use App\Http\Controllers\StafJurusanController;

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

});

