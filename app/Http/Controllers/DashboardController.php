<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Peserta;
use App\Models\Pendaftaran;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'events' => Event::count(),
            'peserta' => Peserta::count(),
            'pendaftaran' => Pendaftaran::count(),
            'presensi' => Presensi::count(),
        ];

        $attendance = Presensi::query()
            ->select('status_kehadiran', DB::raw('COUNT(*) as total'))
            ->groupBy('status_kehadiran')
            ->pluck('total', 'status_kehadiran');

        $registrations = Event::query()
            ->withCount('pendaftarans')
            ->orderByDesc('pendaftarans_count')
            ->take(7)
            ->get();

        $upcomingEvents = Event::query()
            ->whereIn('status_event', ['aktif', 'berlangsung'])
            ->where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats', 'attendance', 'registrations', 'upcomingEvents'
        ));
    }
}
