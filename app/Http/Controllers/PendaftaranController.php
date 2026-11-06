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
}