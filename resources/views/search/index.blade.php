@extends('layouts.admin')
@section('title','Pencarian')
@section('content')
<div class="page-heading">
    <div>
        <p class="eyebrow">GLOBAL SEARCH</p>
        <h1>Hasil pencarian</h1>
        <p class="muted">{{ $term !== '' ? 'Kata kunci: '.$term : 'Cari data dari seluruh modul EventHub.' }}</p>
    </div>
</div>
<form class="filter-bar" method="GET">
    <input name="q" value="{{ $term }}" placeholder="Nama event, peserta, atau email...">
    <button class="btn primary">Cari</button>
</form>
@if($term !== '')
<div class="search-results">
    <section class="panel">
        <h2>Events</h2>
        @forelse($events as $item)
        <a class="search-item" href="{{ route('events.show',$item) }}">
            <b>{{ $item->nama_event }}</b>
            <small>{{ $item->lokasi }}</small>
        </a>
        @empty
        <p class="muted">Tidak ada event.</p>
        @endforelse
    </section>
    <section class="panel">
        <h2>Peserta</h2>
        @forelse($pesertas as $item)
        <a class="search-item" href="{{ route('pesertas.index',['search'=>$item->email]) }}">
            <b>{{ $item->nama }}</b>
            <small>{{ $item->email }}</small>
        </a>
        @empty
        <p class="muted">Tidak ada peserta.</p>
        @endforelse
    </section>
    <section class="panel">
        <h2>Pendaftaran</h2>
        @forelse($pendaftarans as $item)
        <a class="search-item" href="{{ route('pendaftarans.index') }}">
            <b>{{ $item->peserta?->nama }} · {{ $item->event?->nama_event }}</b>
            <small>{{ $item->status_pendaftaran }}</small>
        </a>
        @empty
        <p class="muted">Tidak ada pendaftaran.</p>
        @endforelse
    </section>
</div>
@endif
@endsection
