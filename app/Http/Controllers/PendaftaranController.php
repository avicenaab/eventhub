<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PendaftaranImport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Peserta;
use App\Models\Event;

class PendaftaranController extends Controller
{
    
public function index(Request $request)
{
    $sort = $request->query('sort', 'terbaru');

    $pendaftarans = Pendaftaran::with(['peserta', 'event'])
        ->orderBy(
            'tanggal_daftar',
            $sort === 'terlama' ? 'asc' : 'desc'
        )
        ->get();

    return view('pendaftarans.index', compact('pendaftarans', 'sort'));
}


    public function create()
    {
    $pesertas = Peserta::all();
    $events = Event::all();

    return view('pendaftarans.create', compact(
        'pesertas',
        'events'
    ));
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
    $pesertas = Peserta::all();
    $events = Event::all();

    return view('pendaftarans.edit', compact(
        'pendaftaran',
        'pesertas',
        'events'
    ));
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
    $pendaftarans = Pendaftaran::with(['peserta', 'event'])->get();

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