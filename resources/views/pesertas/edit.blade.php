@extends('layouts.admin')
@section('title','Edit Peserta')
@section('content')
<div class="page-heading">
    <div>
        <p class="eyebrow">UPDATE RECORD</p>
        <h1>Edit Peserta</h1>
    </div>
</div>
<section class="panel form-panel">
    <form method="POST" action="{{ route('pesertas.update',$peserta) }}" class="stack-form">@csrf @method('PUT')
        @include('pesertas.form')
        <div class="form-actions">
            <a class="btn outline" href="{{ route('pesertas.index') }}">Batal</a>
            <button class="btn primary">Simpan perubahan</button>
        </div>
    </form>
</section>
@endsection
