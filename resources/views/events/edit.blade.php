@extends('layouts.admin')

@section('title', 'Events')

@section('content')
<div class="legacy-module-page">
<div class="header">
            <h1>Edit Event</h1>
            <p>Perbarui informasi event yang sudah terdaftar.</p>
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

            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('events.form')

                <div class="form-actions">
                    <button type="submit">Simpan Perubahan</button>
                    <a href="{{ route('events.index') }}" class="back">Kembali</a>
                </div>
            </form>
</div>
@endsection

