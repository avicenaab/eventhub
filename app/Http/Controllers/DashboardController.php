<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Peserta;
use App\Models\Pendaftaran;
use App\Models\Presensi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalPeserta = Peserta::count();
        $totalPendaftaran = Pendaftaran::count();
        $totalPresensi = Presensi::count();

        return view('welcome', compact(
            'totalEvents',
            'totalPeserta',
            'totalPendaftaran',
            'totalPresensi'
        ));
    }
}
