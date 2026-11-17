<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftaran;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->validate(['period' => ['nullable', 'in:7,30,90,365']])['period'] ?? '30';
        $from = now()->subDays((int) $period - 1)->startOfDay();

        $dailyCounts = Pendaftaran::query()
            ->selectRaw('DATE(tanggal_daftar) as day, COUNT(*) as total')
            ->whereDate('tanggal_daftar', '>=', $from)
            ->whereDate('tanggal_daftar', '<=', now()->endOfDay())
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        $daily = collect(CarbonPeriod::create($from->copy(), now()->startOfDay()))
            ->map(fn ($date) => [
                'day' => $date->format('d M'),
                'total' => (int) ($dailyCounts[$date->toDateString()] ?? 0),
            ]);

        $registrationStatus = Pendaftaran::query()
            ->select('status_pendaftaran', DB::raw('COUNT(*) as total'))
            ->groupBy('status_pendaftaran')->pluck('total', 'status_pendaftaran');

        $paymentStatus = Pendaftaran::query()
            ->select('status_pembayaran', DB::raw('COUNT(*) as total'))
            ->groupBy('status_pembayaran')->pluck('total', 'status_pembayaran');

        $eventStats = Event::withCount('pendaftarans')->orderByDesc('pendaftarans_count')->get();
        $attendance = Presensi::query()
            ->select('status_kehadiran', DB::raw('COUNT(*) as total'))
            ->groupBy('status_kehadiran')->pluck('total', 'status_kehadiran');

        return view('analytics.index', compact(
            'period', 'daily', 'registrationStatus', 'paymentStatus', 'eventStats', 'attendance'
        ));
    }
}
