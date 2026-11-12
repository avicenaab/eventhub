<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\SuperAdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataManagementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PublicEventController;
use Illuminate\Support\Facades\Route;

// PUBLIC: Guest dapat mengakses tanpa akun.
Route::get('/', [PublicEventController::class, 'home'])->name('home');
Route::get('/events', [PublicEventController::class, 'index'])->name('public.events.index');
Route::get('/events/{event}', [PublicEventController::class, 'show'])->name('public.events.show');
Route::get('/events/{event}/register', [PublicEventController::class, 'register'])->name('public.events.register');
Route::post('/events/{event}/register', [PublicEventController::class, 'storeRegistration'])->middleware('throttle:10,1')->name('public.events.store');
Route::get('/registration/confirmation/{token}', [PublicEventController::class, 'confirmation'])->name('public.registration.confirmation');
Route::get('/presensi', [PublicEventController::class, 'attendanceForm'])->name('public.attendance.form');
Route::post('/presensi', [PublicEventController::class, 'submitAttendance'])->middleware('throttle:10,1')->name('public.attendance.submit');

// SUPER ADMIN authentication. Tidak ada public sign-up.
Route::get('/admin/login', [SuperAdminAuthController::class, 'create'])->middleware('guest')->name('admin.login');
Route::post('/admin/login', [SuperAdminAuthController::class, 'store'])->middleware(['guest', 'throttle:5,1'])->name('admin.login.store');
Route::post('/admin/logout', [SuperAdminAuthController::class, 'destroy'])->middleware(['auth', 'superadmin'])->name('admin.logout');

// PRIVATE: semua halaman manajemen hanya untuk Super Admin yang sudah login.
Route::middleware(['auth', 'superadmin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    Route::get('/search', [GlobalSearchController::class, 'index'])->name('search.index');

    Route::prefix('data-management')->name('data-management.')->group(function () {
        Route::get('/', [DataManagementController::class, 'index'])->name('index');
        Route::post('/import', [DataManagementController::class, 'import'])->name('import');
        Route::get('/export/{type}/{format}', [DataManagementController::class, 'export'])->name('export');
    });

    Route::resource('events', EventController::class);
    Route::resource('pesertas', PesertaController::class)->except(['show']);
    Route::resource('presensis', PresensiController::class);

    // Route lama Pendaftaran dipertahankan, tetapi sekarang berada di balik auth.
    Route::get('/pendaftarans', [PendaftaranController::class, 'index'])->name('pendaftarans.index');
    Route::get('/pendaftarans/create', [PendaftaranController::class, 'create'])->name('pendaftarans.create');
    Route::post('/pendaftarans', [PendaftaranController::class, 'store'])->name('pendaftarans.store');
    Route::get('/pendaftarans/export', [PendaftaranController::class, 'export'])->name('pendaftarans.export');
    Route::post('/pendaftarans/import', [PendaftaranController::class, 'import'])->name('pendaftarans.import');
    Route::get('/pendaftarans/pdf', [PendaftaranController::class, 'pdf'])->name('pendaftarans.pdf');
    Route::get('/pendaftarans/chart', [PendaftaranController::class, 'chart'])->name('pendaftarans.chart');
    Route::get('/pendaftarans/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftarans.edit');
    Route::put('/pendaftarans/{id}', [PendaftaranController::class, 'update'])->name('pendaftarans.update');
    Route::delete('/pendaftarans/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftarans.destroy');
});
