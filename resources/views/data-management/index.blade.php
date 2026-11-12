@extends('layouts.admin')
@section('title','Import / Export')
@section('content')
<div class="page-heading">
    <div>
        <p class="eyebrow">DATA TOOLS</p>
        <h1>Import / Export</h1>
        <p class="muted">Kelola pertukaran data seluruh modul dari satu tempat.</p>
    </div>
</div>
@if($errors->any())
<div class="alert error">
    @foreach($errors->all() as $error)
    <div>{{ $error }}</div>
    @endforeach
</div>
@endif
@if(session('import_result'))
<div class="alert success">{{ session('import_result.created') }} baris berhasil diproses.</div>
@if(count(session('import_result.errors',[])))
<section class="panel">
    <h3>Baris yang perlu diperiksa</h3>
    @foreach(session('import_result.errors') as $error)
    <p class="field-error">{{ $error }}</p>
    @endforeach
</section>
@endif
@endif
<div class="data-grid">
    @foreach([['events','Events','Data kegiatan dan jadwal.'],['pesertas','Peserta','Identitas peserta EventHub.'],['pendaftarans','Pendaftaran','Relasi peserta dengan event.'],['presensis','Presensi','Status kehadiran peserta.']] as [$type,$label,$description])
    <section class="panel data-panel">
        <div class="data-icon">⇅</div>
        <h2>{{ $label }}</h2>
        <p class="muted">{{ $description }}</p>
        <div class="export-actions">
            <a class="btn outline" href="{{ route('data-management.export',[$type,'xlsx']) }}">Excel</a>
            <a class="btn outline" href="{{ route('data-management.export',[$type,'pdf']) }}">PDF</a>
        </div>
        <form class="import-form" method="POST" action="{{ route('data-management.import') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <label>Import Excel / CSV
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required>
            </label>
            <button class="btn primary full">Import data</button>
        </form>
    </section>
    @endforeach
</div>
<p class="tiny muted">Import akan memvalidasi tiap baris. Pastikan format kolom sesuai dengan file hasil export. Lakukan backup database sebelum import data dalam jumlah besar.</p>
@endsection
