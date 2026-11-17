@extends('layouts.admin')

@section('title', 'Events')

@section('content')
<div class="legacy-module-page">
<div class="header">
            <h1>Tambah Event</h1>
            <p>Tambahkan informasi event baru ke EventHub.</p>
        </div>

        <div class="form-card">

            @if($errors->any())
                <div class="error-box">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                @include('events.form')

                <button type="submit">Simpan Event</button>
                <a href="{{ route('events.index') }}" class="back">Kembali</a>
            </form>
</div>
@endsection

