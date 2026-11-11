<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk fitur Peserta milik Kay
Route::resource('pesertas', PesertaController::class);

Route::get('/pendaftarans', [PendaftaranController::class, 'index'])
    ->name('pendaftarans.index');

Route::get('/pendaftarans/create', [PendaftaranController::class, 'create'])
    ->name('pendaftarans.create');

Route::post('/pendaftarans', [PendaftaranController::class, 'store'])
    ->name('pendaftarans.store');
    
Route::get('/pendaftarans/export', [PendaftaranController::class, 'export'])
    ->name('pendaftarans.export');

Route::post('/pendaftarans/import', [PendaftaranController::class, 'import'])
    ->name('pendaftarans.import');

Route::get('/pendaftarans/pdf', [PendaftaranController::class, 'pdf'])
    ->name('pendaftarans.pdf');

Route::get('/pendaftarans/chart', [PendaftaranController::class, 'chart'])
    ->name('pendaftarans.chart');
    
Route::get('/pendaftarans/{id}/edit', [PendaftaranController::class, 'edit'])
    ->name('pendaftarans.edit');

Route::put('/pendaftarans/{id}', [PendaftaranController::class, 'update'])
    ->name('pendaftarans.update');

Route::delete('/pendaftarans/{id}', [PendaftaranController::class, 'destroy'])
    ->name('pendaftarans.destroy');

Route::resource('presensis', PresensiController::class);
Route::resource('events', EventController::class);