@extends('public.layout')
@section('title','Pendaftaran '.$event->nama_event)
@section('content')
<section class="public-section form-section">
    <a class="text-link" href="{{ route('public.events.show',$event) }}">← Kembali ke detail event</a>
    <p class="eyebrow">REGISTRATION FORM</p>
    <h1>Daftar event</h1>
    <p class="muted">{{ $event->nama_event }} · {{ $event->tanggal_mulai->format('d M Y') }}</p>
    @if($errors->any())
        <div class="alert error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('public.events.store',$event) }}" class="stack-form">
        @csrf
        <label>Nama lengkap
            <input name="nama" value="{{ old('nama') }}" required maxlength="255">
        </label>
        <label>Email aktif
            <input type="email" name="email" value="{{ old('email') }}" required maxlength="255">
        </label>
        <label>Nomor HP
            <input name="no_hp" value="{{ old('no_hp') }}" required maxlength="30">
        </label>
        <label>Instansi
            <input name="instansi" value="{{ old('instansi') }}" required maxlength="255">
        </label>
        <label class="check-line">
            <input type="checkbox" name="agreement" value="1" required> Saya memastikan data yang diisi benar.
        </label>
        <button class="btn primary full">Kirim pendaftaran</button>
        <p class="tiny muted">Data akan digunakan untuk keperluan administrasi event ini.</p>
    </form>
</section>
@endsection
