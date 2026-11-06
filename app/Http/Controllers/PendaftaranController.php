<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PendaftaranImport;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function export()
{
    return Excel::download(
        new PendaftaranExport,
        'data-pendaftaran.xlsx'
    );
}
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    Excel::import(
        new PendaftaranImport,
        $request->file('file')
    );

    return redirect()->route('pendaftarans.index')
        ->with('success', 'Data berhasil diimport!');
}
    public function pdf()
{
    $pendaftarans = Pendaftaran::all();

    $pdf = Pdf::loadView('pendaftarans.pdf', compact('pendaftarans'));

    return $pdf->download('data-pendaftaran.pdf');
}
    public function chart()
{
    $pendaftaran = Pendaftaran::selectRaw(
        'status_pendaftaran, COUNT(*) as total'
    )
    ->groupBy('status_pendaftaran')
    ->get();

    $pembayaran = Pendaftaran::selectRaw(
        'status_pembayaran, COUNT(*) as total'
    )
    ->groupBy('status_pembayaran')
    ->get();

    return view('pendaftarans.chart', compact(
        'pendaftaran',
        'pembayaran'
    ));
}
}