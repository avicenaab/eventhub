@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="page-heading">
    <div>
        <p class="eyebrow">OVERVIEW</p>
        <h1>Dashboard</h1>
        <p class="muted">Ringkasan aktivitas EventHub hari ini.</p>
    </div><a class="btn primary" href="{{ route('events.create') }}">＋ Buat event</a>
</div>
<div class="stats-grid">
    @foreach([['Total Events',$stats['events'],'▦'],['Total Peserta',$stats['peserta'],'♙'],['Pendaftaran',$stats['pendaftaran'],'☷'],['Data Presensi',$stats['presensi'],'✓']] as $stat)
    <article class="stat-card">
        <div class="stat-icon">{{ $stat[2] }}</div>
        <p>{{ $stat[0] }}</p>
        <strong data-count="{{ $stat[1] }}">0</strong>
    </article>
    @endforeach
</div>
<section class="quick-actions">
    <div class="section-heading">
        <div>
            <p class="eyebrow">SHORTCUTS</p>
            <h2>Quick Actions</h2>
        </div>
    </div>
    <div class="action-grid">
        <a href="{{ route('events.create') }}">＋ <span>
            <b>Tambah Event</b>
            <small>Buat kegiatan baru</small>
        </span>
    </a>
    <a href="{{ route('pesertas.create') }}">＋ <span>
        <b>Tambah Peserta</b>
        <small>Input data peserta</small>
    </span></a>
    <a href="{{ route('pendaftarans.create') }}">＋ <span>
        <b>Buat Pendaftaran</b>
        <small>Daftarkan peserta</small>
    </span></a>
    <a href="{{ route('presensis.create') }}">＋ <span>
        <b>Catat Presensi</b>
        <small>Perbarui kehadiran</small>
    </span></a>
</div></section>
<div class="dashboard-grid">
    <section class="panel">
        <div class="panel-heading">
            <div>
                <p class="eyebrow">ATTENDANCE</p>
                <h2>Distribusi Presensi</h2>
            </div>
        </div>
        <div class="chart-wrap">
            @if($attendance->isEmpty())
                <div class="empty-state">Belum ada data presensi untuk ditampilkan.</div>
            @else
                <canvas id="attendanceChart"></canvas>
            @endif
        </div>
    </section>
    <section class="panel">
        <div class="panel-heading">
            <div>
                <p class="eyebrow">REGISTRATIONS</p>
                <h2>Pendaftaran per Event</h2>
            </div>
        </div>
        <div class="chart-wrap">
            @if($registrations->isEmpty())
                <div class="empty-state">Belum ada data event dan pendaftaran untuk ditampilkan.</div>
            @else
                <canvas id="eventChart"></canvas>
            @endif
        </div>
    </section>
</div>
<div class="dashboard-grid lower-grid">
    <section class="panel">
        <div class="panel-heading">
            <div><p class="eyebrow">UPCOMING</p><h2>Event mendatang</h2></div>
            <a class="text-link" href="{{ route('events.index') }}">Kelola →</a>
        </div>
        <div class="list-stack">
            @forelse($upcomingEvents as $event)
                <div class="list-row">
                    <div><b>{{ $event->nama_event }}</b><small>{{ $event->tanggal_mulai->format('d M Y · H:i') }} · {{ $event->lokasi }}</small></div>
                    <span class="status-pill">{{ $event->kuota }} slot</span>
                </div>
            @empty
                <div class="empty-state">Belum ada event mendatang.</div>
            @endforelse
        </div>
    </section>
</div>
@endsection
@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', () => {
const attendance = @json($attendance);
const eventLabels = @json($registrations->pluck('nama_event'));
const eventValues = @json($registrations->pluck('pendaftarans_count'));
const chartText = '#a1a1aa';
if (typeof Chart !== 'undefined') {
if (document.getElementById('attendanceChart')) new Chart(document.getElementById('attendanceChart'), {type:'doughnut',data:{labels:Object.keys(attendance),datasets:[{data:Object.values(attendance),backgroundColor:['#55d6c2','#7aa7ff','#b49aff','#f3c969','#ef7777'],borderWidth:0,hoverOffset:5}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom',labels:{color:chartText,padding:18}}},cutout:'72%'}});
if (document.getElementById('eventChart')) new Chart(document.getElementById('eventChart'), {type:'bar',data:{labels:eventLabels,datasets:[{label:'Pendaftaran',data:eventValues,backgroundColor:'#55d6c2',borderRadius:7,maxBarThickness:34}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{ticks:{color:chartText},grid:{display:false}},y:{beginAtZero:true,ticks:{color:chartText,precision:0},grid:{color:'#383838'}}}}});
}
document.querySelectorAll('[data-count]').forEach(el=>{const end=Number(el.dataset.count);let start=0;const step=Math.max(1,Math.ceil(end/35));const timer=setInterval(()=>{start=Math.min(end,start+step);el.textContent=start.toLocaleString('id-ID');if(start>=end)clearInterval(timer)},18)});
});
</script>@endpush
