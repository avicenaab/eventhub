<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Peserta;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PublicEventController extends Controller
{
    public function home()
    {
        $events = Event::query()
            ->whereIn('status_event', ['aktif', 'berlangsung'])
            ->where('tanggal_mulai', '>=', now()->startOfDay())
            ->withCount('pendaftarans')
            ->orderBy('tanggal_mulai')
            ->take(6)
            ->get();

        return view('public.home', compact('events'));
    }

    public function index(Request $request)
    {
        $events = Event::query()
            ->whereIn('status_event', ['aktif', 'berlangsung'])
            ->where('tanggal_mulai', '>=', now()->startOfDay())
            ->when($request->filled('q'), fn ($q) => $q->where(function ($sub) use ($request) {
                $term = trim($request->string('q')->toString());
                $sub->where('nama_event', 'like', "%{$term}%")
                    ->orWhere('lokasi', 'like', "%{$term}%");
            }))
            ->orderBy('tanggal_mulai')
            ->paginate(9)
            ->withQueryString();

        return view('public.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        abort_unless(in_array($event->status_event, ['aktif', 'berlangsung'], true), 404);
        abort_if($event->tanggal_mulai->lt(now()->startOfDay()), 404);

        $registered = $event->pendaftarans()
            ->where('status_pendaftaran', '!=', 'ditolak')
            ->count();
        $remaining = max(0, $event->kuota - $registered);

        return view('public.events.show', compact('event', 'remaining'));
    }

    public function register(Event $event)
    {
        abort_unless(in_array($event->status_event, ['aktif', 'berlangsung'], true), 404);
        abort_if($event->tanggal_mulai->lt(now()->startOfDay()), 404);
        $registered = $event->pendaftarans()->where('status_pendaftaran', '!=', 'ditolak')->count();
        abort_if($registered >= $event->kuota, 410, 'Kuota event sudah penuh.');

        return view('public.events.register', compact('event'));
    }

    public function storeRegistration(Request $request, Event $event)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'instansi' => ['required', 'string', 'max:255'],
            'agreement' => ['accepted'],
        ], [
            'agreement.accepted' => 'Kamu harus menyetujui ketentuan pendaftaran.',
        ]);

        $pendaftaran = DB::transaction(function () use ($validated, $event) {
            $lockedEvent = Event::query()->lockForUpdate()->findOrFail($event->id);

            if (! in_array($lockedEvent->status_event, ['aktif', 'berlangsung'], true)
                || $lockedEvent->tanggal_mulai->lt(now()->startOfDay())) {
                throw ValidationException::withMessages(['event' => 'Pendaftaran event ini sudah ditutup.']);
            }

            $registered = Pendaftaran::where('event_id', $lockedEvent->id)
                ->where('status_pendaftaran', '!=', 'ditolak')
                ->count();

            if ($registered >= $lockedEvent->kuota) {
                throw ValidationException::withMessages(['event' => 'Maaf, kuota event sudah penuh.']);
            }

            $peserta = Peserta::firstOrCreate(
                ['email' => strtolower($validated['email'])],
                [
                    'nama' => $validated['nama'],
                    'no_hp' => $validated['no_hp'],
                    'instansi' => $validated['instansi'],
                ]
            );

            $alreadyRegistered = Pendaftaran::where('event_id', $lockedEvent->id)
                ->where('peserta_id', $peserta->id)
                ->where('status_pendaftaran', '!=', 'ditolak')
                ->exists();

            if ($alreadyRegistered) {
                throw ValidationException::withMessages(['email' => 'Email ini sudah terdaftar pada event tersebut.']);
            }

            return Pendaftaran::create([
                'public_token' => (string) Str::uuid(),
                'attendance_code' => Str::upper(Str::random(8)),
                'tanggal_daftar' => now()->toDateString(),
                'peserta_id' => $peserta->id,
                'event_id' => $lockedEvent->id,
                'status_pendaftaran' => 'menunggu',
                // Event gratis tidak memerlukan pembayaran.
                'status_pembayaran' => (float) $lockedEvent->biaya <= 0 ? 'gratis' : 'belum_bayar',
            ]);
        }, 3);

        return redirect()->route('public.registration.confirmation', $pendaftaran->public_token)
            ->with('registration_email', $validated['email']);
    }

    public function confirmation(string $token)
    {
        $pendaftaran = Pendaftaran::where('public_token', $token)->firstOrFail();
        $pendaftaran->load(['peserta', 'event']);

        return view('public.confirmation', compact('pendaftaran'));
    }


    public function attendanceForm()
    {
        return view('public.attendance');
    }

    public function submitAttendance(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'size:8'],
        ], [
            'code.required' => 'Masukkan kode presensi.',
            'code.size' => 'Kode presensi harus terdiri dari 8 karakter.',
        ]);

        $pendaftaran = Pendaftaran::with(['peserta', 'event'])
            ->where('attendance_code', Str::upper(trim($validated['code'])))
            ->first();

        if (! $pendaftaran || $pendaftaran->status_pendaftaran === 'ditolak') {
            throw ValidationException::withMessages(['code' => 'Kode tidak valid atau pendaftaran tidak memenuhi syarat.']);
        }

        $presensi = $pendaftaran->presensis()->first();
        if ($presensi && $presensi->status_kehadiran === 'hadir') {
            throw ValidationException::withMessages(['code' => 'Presensi untuk kode ini sudah tercatat.']);
        }

        if ($presensi) {
            $presensi->update(['status_kehadiran' => 'hadir', 'waktu_hadir' => now()]);
        } else {
            $pendaftaran->presensis()->create(['status_kehadiran' => 'hadir', 'waktu_hadir' => now()]);
        }

        return view('public.attendance-success', compact('pendaftaran'));
    }
}
