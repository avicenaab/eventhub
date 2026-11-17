<?php

namespace App\Http\Controllers;

use App\Exports\GenericDataExport;
use App\Imports\GenericDataImport;
use App\Models\Event;
use App\Models\Peserta;
use App\Models\Pendaftaran;
use App\Models\Presensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DataManagementController extends Controller
{
    private array $types = ['events', 'pesertas', 'pendaftarans', 'presensis'];

    private function dataset(string $type): array
    {
        abort_unless(in_array($type, $this->types, true), 404);

        return match ($type) {
            'events' => [Event::query()->orderBy('id')->get(['id','nama_event','deskripsi','tanggal_mulai','tanggal_selesai','lokasi','kuota','biaya','status_event']), ['id','nama_event','deskripsi','tanggal_mulai','tanggal_selesai','lokasi','kuota','biaya','status_event']],
            'pesertas' => [Peserta::query()->orderBy('id')->get(['id','nama','email','no_hp','instansi']), ['id','nama','email','no_hp','instansi']],
            'pendaftarans' => [Pendaftaran::with(['peserta','event'])->orderBy('id')->get()->map(fn ($p) => ['id'=>$p->id,'tanggal_daftar'=>$p->tanggal_daftar,'nama_peserta'=>$p->peserta?->nama,'email_peserta'=>$p->peserta?->email,'nama_event'=>$p->event?->nama_event,'status_pendaftaran'=>$p->status_pendaftaran,'status_pembayaran'=>$p->status_pembayaran]), ['id','tanggal_daftar','nama_peserta','email_peserta','nama_event','status_pendaftaran','status_pembayaran']],
            'presensis' => [Presensi::with(['pendaftaran.peserta','pendaftaran.event'])->orderBy('id')->get()->map(fn ($p) => ['id'=>$p->id,'pendaftaran_id'=>$p->pendaftaran_id,'nama_peserta'=>$p->pendaftaran?->peserta?->nama,'nama_event'=>$p->pendaftaran?->event?->nama_event,'waktu_hadir'=>$p->waktu_hadir,'status_kehadiran'=>$p->status_kehadiran]), ['id','pendaftaran_id','nama_peserta','nama_event','waktu_hadir','status_kehadiran']],
        };
    }

    public function index()
    {
        return view('data-management.index');
    }

    public function export(string $type, string $format)
    {
        abort_unless(in_array($format, ['xlsx', 'pdf'], true), 404);
        [$rows, $headers] = $this->dataset($type);

        if ($format === 'xlsx') {
            return Excel::download(new GenericDataExport($rows, $headers), "{$type}.xlsx");
        }

        $pdf = Pdf::loadView('data-management.pdf', compact('rows', 'headers', 'type'));
        return $pdf->download("{$type}.pdf");
    }

    public function import(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:events,pesertas,pendaftarans,presensis'],
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ]);

        $import = new GenericDataImport();
        Excel::import($import, $request->file('file'));
        $rows = $import->rows ?? collect();

        if ($rows->isEmpty()) {
            return back()->withErrors(['file' => 'File tidak memiliki baris data.']);
        }

        $type = $validated['type'];
        $errors = [];
        $created = 0;

        DB::transaction(function () use ($rows, $type, &$errors, &$created) {
            foreach ($rows as $index => $row) {
                $line = $index + 2;
                $row = $row->toArray();
                $rules = match ($type) {
                    'events' => ['nama_event'=>'required|string|max:255','tanggal_mulai'=>'required|date','lokasi'=>'required|string|max:255','kuota'=>'required|integer|min:1','biaya'=>'required|numeric|min:0','status_event'=>'required|in:draft,aktif,berlangsung,selesai'],
                    'pesertas' => ['nama'=>'required|string|max:255','email'=>'required|email|max:255','no_hp'=>'required|string|max:30','instansi'=>'required|string|max:255'],
                    'pendaftarans' => ['tanggal_daftar'=>'required|date','email_peserta'=>'required|email','nama_event'=>'required|string','status_pendaftaran'=>'required|string','status_pembayaran'=>'required|string'],
                    'presensis' => ['pendaftaran_id'=>'required|integer|exists:pendaftarans,id','status_kehadiran'=>'required|in:belum_hadir,hadir,izin,sakit,alpa'],
                };
                $validator = Validator::make($row, $rules);
                if ($validator->fails()) {
                    $errors[] = "Baris {$line}: ".implode(' ', $validator->errors()->all());
                    continue;
                }
                try {
                    match ($type) {
                        'events' => Event::create(collect($row)->only(['nama_event','deskripsi','tanggal_mulai','tanggal_selesai','lokasi','kuota','biaya','status_event'])->all()),
                        'pesertas' => Peserta::updateOrCreate(['email'=>strtolower($row['email'])], collect($row)->only(['nama','email','no_hp','instansi'])->all()),
                        'pendaftarans' => $this->importPendaftaran($row),
                        'presensis' => Presensi::updateOrCreate(['pendaftaran_id'=>$row['pendaftaran_id']], ['waktu_hadir'=>$row['waktu_hadir'] ?? null,'status_kehadiran'=>$row['status_kehadiran']]),
                    };
                    $created++;
                } catch (\Throwable $e) {
                    $errors[] = "Baris {$line}: ".$e->getMessage();
                }
            }
        });

        return back()->with('import_result', ['created'=>$created, 'errors'=>$errors]);
    }

    private function importPendaftaran(array $row): Pendaftaran
    {
        $peserta = Peserta::where('email', strtolower($row['email_peserta']))->first();
        $event = Event::where('nama_event', $row['nama_event'])->first();
        if (! $peserta || ! $event) {
            throw new \RuntimeException('Email peserta atau nama event tidak ditemukan.');
        }
        return Pendaftaran::create([
            'tanggal_daftar'=>$row['tanggal_daftar'], 'peserta_id'=>$peserta->id, 'event_id'=>$event->id,
            'status_pendaftaran'=>$row['status_pendaftaran'], 'status_pembayaran'=>$row['status_pembayaran'],
        ]);
    }
}
