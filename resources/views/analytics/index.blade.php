
@extends('layouts.admin')

@section('title', 'Analitik')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">INSIGHTS</p>
            <h1>Analitik</h1>
            <p class="muted">Pantau tren pendaftaran dan performa event.</p>
        </div>

        <form method="GET">
            <select name="period" onchange="this.form.submit()">
                <option value="7" @selected($period == '7')>7 hari</option>
                <option value="30" @selected($period == '30')>30 hari</option>
                <option value="90" @selected($period == '90')>90 hari</option>
                <option value="365" @selected($period == '365')>1 tahun</option>
            </select>
        </form>
    </div>

    <div class="dashboard-grid">
        <section class="panel">
            <div class="panel-heading">
                <div>
                    <p class="eyebrow">TREND</p>
                    <h2>Tren Pendaftaran</h2>
                </div>
            </div>

            <div class="chart-wrap tall">
                @if($daily->sum('total') === 0)
                    <div class="empty-state">Belum ada data pendaftaran pada periode ini.</div>
                @else
                    <canvas id="trendChart"></canvas>
                @endif
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <p class="eyebrow">ATTENDANCE</p>
                    <h2>Status Presensi</h2>
                </div>
            </div>

            <div class="chart-wrap tall">
                @if($attendance->isEmpty())
                    <div class="empty-state">Belum ada data presensi.</div>
                @else
                    <canvas id="attendanceChart"></canvas>
                @endif
            </div>
        </section>
    </div>

    <div class="dashboard-grid">
        <section class="panel">
            <div class="panel-heading">
                <div>
                    <p class="eyebrow">REGISTRATION</p>
                    <h2>Status Pendaftaran</h2>
                </div>
            </div>

            <div class="chart-wrap">
                @if($registrationStatus->isEmpty())
                    <div class="empty-state">Belum ada data status pendaftaran.</div>
                @else
                    <canvas id="registrationChart"></canvas>
                @endif
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <p class="eyebrow">PAYMENT</p>
                    <h2>Status Pembayaran</h2>
                </div>
            </div>

            <div class="chart-wrap">
                @if($paymentStatus->isEmpty())
                    <div class="empty-state">Belum ada data pembayaran.</div>
                @else
                    <canvas id="paymentChart"></canvas>
                @endif
            </div>
        </section>
    </div>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <p class="eyebrow">EVENT PERFORMANCE</p>
                <h2>Jumlah Pendaftar per Event</h2>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Tanggal</th>
                        <th>Pendaftar</th>
                        <th>Kuota</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($eventStats as $event)
                        <tr>
                            <td>{{ $event->nama_event }}</td>
                            <td>{{ $event->tanggal_mulai?->format('d M Y') ?? '-' }}</td>
                            <td>{{ $event->pendaftarans_count }}</td>
                            <td>{{ $event->kuota }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">Belum ada data event.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
    
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof Chart === 'undefined') { console.error('Chart.js gagal dimuat. Periksa koneksi CDN.'); }
        const labelsColor = '#a1a1aa';
        const gridColor = '#383838';

        const daily = @json($daily);

        const base = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: labelsColor
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: labelsColor
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: labelsColor,
                        precision: 0
                    },
                    grid: {
                        color: gridColor
                    }
                }
            }
        };

        if (document.getElementById('trendChart')) new Chart(document.getElementById('trendChart'), {
            type: 'line',
            data: {
                labels: daily.map(x => x.day),
                datasets: [{
                    label: 'Pendaftaran',
                    data: daily.map(x => x.total),
                    borderColor: '#55d6c2',
                    backgroundColor: 'rgba(85, 214, 194, .12)',
                    fill: true,
                    tension: 0.35
                }]
            },
            options: base
        });

        const makeDoughnut = (id, obj) => {
            const canvas = document.getElementById(id);
            if (!canvas || !Object.keys(obj).length) return;
            new Chart(canvas, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(obj),
                    datasets: [{
                        data: Object.values(obj),
                        backgroundColor: [
                            '#55d6c2',
                            '#7aa7ff',
                            '#b49aff',
                            '#f3c969',
                            '#ef7777'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: labelsColor
                            }
                        }
                    },
                    cutout: '68%'
                }
            });
        };

        makeDoughnut('attendanceChart', @json($attendance));
        makeDoughnut('registrationChart', @json($registrationStatus));
        makeDoughnut('paymentChart', @json($paymentStatus));
    });
    </script>
@endpush