<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::all();

        return view('pendaftarans.index', compact('pendaftarans'));
    }

    public function create()
    {
        return view('pendaftarans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_daftar' => 'required|date',
            'peserta_id' => 'required|integer',
            'event_id' => 'required|integer',
            'status_pendaftaran' => 'required|string',
            'status_pembayaran' => 'required|string',
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftarans.index')
            ->with('success', 'Pendaftaran berhasil ditambahkan!');
    }
    public function edit($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);

    return view('pendaftarans.edit', compact('pendaftaran'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'tanggal_daftar' => 'required|date',
        'peserta_id' => 'required|integer',
        'event_id' => 'required|integer',
        'status_pendaftaran' => 'required|string',
        'status_pembayaran' => 'required|string',
    ]);

    $pendaftaran = Pendaftaran::findOrFail($id);

    $pendaftaran->update($request->only([
        'tanggal_daftar',
        'peserta_id',
        'event_id',
        'status_pendaftaran',
        'status_pembayaran',
    ]));

    return redirect()->route('pendaftarans.index')
        ->with('success', 'Pendaftaran berhasil diperbarui!');
}

public function destroy($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    $pendaftaran->delete();

    return redirect()->route('pendaftarans.index')
        ->with('success', 'Pendaftaran berhasil dihapus!');
}
}