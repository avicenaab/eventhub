@extends('layouts.admin')
@section('title','Tambah Peserta')
@section('content')
<div class="page-heading">
    <div>
        <p class="eyebrow">NEW RECORD</p>
        <h1>Tambah Peserta</h1>
    </div>
</div>
<section class="panel form-panel">
    <form method="POST" action="{{ route('pesertas.store') }}" class="stack-form">@csrf
        @include('pesertas.form')
        <div class="form-actions">
            <a class="btn outline" href="{{ route('pesertas.index') }}">Batal</a>
            <button class="btn primary">Simpan peserta</button>
        </div>
    </form>
</section>
@endsection
