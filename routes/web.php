<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;

Route::get('/pendaftarans', [PendaftaranController::class, 'index'])
    ->name('pendaftarans.index');

Route::get('/pendaftarans/create', [PendaftaranController::class, 'create'])
    ->name('pendaftarans.create');

Route::post('/pendaftarans', [PendaftaranController::class, 'store'])
    ->name('pendaftarans.store');