<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;

Route::get('/pendaftarans', [PendaftaranController::class, 'index'])
    ->name('pendaftarans.index');

Route::get('/pendaftarans/create', [PendaftaranController::class, 'create'])
    ->name('pendaftarans.create');

Route::post('/pendaftarans', [PendaftaranController::class, 'store'])
    ->name('pendaftarans.store');
    
Route::get('/pendaftarans/{id}/edit', [PendaftaranController::class, 'edit'])
    ->name('pendaftarans.edit');

Route::put('/pendaftarans/{id}', [PendaftaranController::class, 'update'])
    ->name('pendaftarans.update');

Route::delete('/pendaftarans/{id}', [PendaftaranController::class, 'destroy'])
    ->name('pendaftarans.destroy');