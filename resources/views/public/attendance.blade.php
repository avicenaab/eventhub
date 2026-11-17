@extends('public.layout')
@section('title','Presensi Peserta')
@section('content')
<section class="public-section" style="max-width:680px;margin:70px auto;">
    <p class="eyebrow">GUEST CHECK-IN</p>
    <h1>Presensi Event</h1>
    <p class="muted">Masukkan kode presensi 8 karakter yang kamu terima setelah mendaftar event.</p>
    @if($errors->any())<div class="alert error">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
    <form method="POST" action="{{ route('public.attendance.submit') }}" class="register-panel" style="margin-top:24px;">
        @csrf
        <label for="code">Kode Presensi</label><br>
        <input id="code" name="code" value="{{ old('code') }}" minlength="8" maxlength="8" required autocomplete="one-time-code" placeholder="Cth. A8K2P9QX" style="text-transform:uppercase;letter-spacing:.16em;font-weight:700;">
        <button class="btn primary full" type="submit">Konfirmasi Kehadiran</button>
    </form>
</section>
@endsection
