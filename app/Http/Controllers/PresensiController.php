<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PresensiController extends Controller
{
    // Menampilkan data presensi, pencarian, dan filter
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status_kehadiran' => [
                'nullable',
                Rule::in([
                    'belum_hadir',
                    'hadir',
                    'izin',
                    'sakit',
                    'alpa',
                ]),
            ],
        ]);

        $query = Presensi::with([
            'pendaftaran.peserta',
            'pendaftaran.event',
        ]);

        // Pencarian peserta atau event
        $search = trim($filters['search'] ?? '');

        if ($search !== '') {
            $query->whereHas('pendaftaran', function ($q) use ($search) {
                $q->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->whereHas('peserta', function ($peserta) use ($search) {
                            $peserta->where('nama', 'like', "%{$search}%");
                        })
                        ->orWhereHas('event', function ($event) use ($search) {
                            $event->where('nama_event', 'like', "%{$search}%");
                        });
                });
            });
        }

        // Filter status kehadiran
        if (!empty($filters['status_kehadiran'])) {
            $query->where(
                'status_kehadiran',
                $filters['status_kehadiran']
            );
        }

        $presensis = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('presensis.index', compact('presensis'));
    }

    // Menampilkan form tambah presensi
    public function create()
    {
        $pendaftarans = Pendaftaran::with([
            'peserta',
            'event',
        ])
            ->whereDoesntHave('presensis')
            ->orderByDesc('id')
            ->get();

        return view('presensis.create', compact('pendaftarans'));
    }

    // Menyimpan data presensi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => [
                'required',
                'exists:pendaftarans,id',
                'unique:presensis,pendaftaran_id',
            ],
            'waktu_hadir' => ['nullable', 'date'],
            'status_kehadiran' => [
                'required',
                Rule::in([
                    'belum_hadir',
                    'hadir',
                    'izin',
                    'sakit',
                    'alpa',
                ]),
            ],
        ]);

        Presensi::create($validated);

        return redirect()
            ->route('presensis.index')
            ->with('success', 'Data presensi berhasil ditambahkan.');
    }

    // Menampilkan detail presensi
    public function show(Presensi $presensi)
    {
        $presensi->load([
            'pendaftaran.peserta',
            'pendaftaran.event',
        ]);

        return view('presensis.show', compact('presensi'));
    }

    // Menampilkan form edit presensi
    public function edit(Presensi $presensi)
    {
        $pendaftarans = Pendaftaran::with([
            'peserta',
            'event',
        ])
            ->where(function ($query) use ($presensi) {
                $query
                    ->whereDoesntHave('presensis')
                    ->orWhere('id', $presensi->pendaftaran_id);
            })
            ->orderByDesc('id')
            ->get();

        return view('presensis.edit', compact(
            'presensi',
            'pendaftarans'
        ));
    }

    // Memperbarui data presensi
    public function update(Request $request, Presensi $presensi)
    {
        $validated = $request->validate([
            'pendaftaran_id' => [
                'required',
                'exists:pendaftarans,id',
                Rule::unique('presensis', 'pendaftaran_id')
                    ->ignore($presensi->id),
            ],
            'waktu_hadir' => ['nullable', 'date'],
            'status_kehadiran' => [
                'required',
                Rule::in([
                    'belum_hadir',
                    'hadir',
                    'izin',
                    'sakit',
                    'alpa',
                ]),
            ],
        ]);

        $presensi->update($validated);

        return redirect()
            ->route('presensis.index')
            ->with('success', 'Data presensi berhasil diperbarui.');
    }

    // Menghapus data presensi
    public function destroy(Presensi $presensi)
    {
        $presensi->delete();

        return redirect()
            ->route('presensis.index')
            ->with('success', 'Data presensi berhasil dihapus.');
    }
}