@extends('layouts.admin')

@section('title', 'Analitik')

@push('styles')
<style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f4f6fb;
            color: #263248;
        }

        .legacy-module-page .sidebar {
            width: 240px;
            background: #172554;
            color: white;
            padding: 30px 20px;
        }

        .legacy-module-page .brand {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .legacy-module-page .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .legacy-module-page .sidebar a:hover,
        .legacy-module-page .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 40px;
        }

        .legacy-module-page .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .legacy-module-page .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .legacy-module-page .header p {
            color: #64748b;
        }

        .back {
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .charts {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
        }

        .chart-box {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        }

        .chart-box h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .chart-box p {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .chart-container {
            position: relative;
            height: 320px;
        }

        @media (max-width: 900px) {
            .charts {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            body {
                flex-direction: column;
            }

            .legacy-module-page .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }
        }
    

/* Compatibility overrides: shared EventHub admin shell */
body { display:block !important; min-height:100vh; background:var(--bg) !important; color:var(--text) !important; font-family:'DM Sans',sans-serif !important; }
.legacy-module-page 
.legacy-module-page .main { width:auto !important; min-height:0 !important; margin:0 !important; padding:0 !important; flex:initial !important; background:transparent !important; }
.layout { display:block !important; min-height:0 !important; }
.legacy-module-page .footer { display:none !important; }

</style>
@endpush

@section('content')
<div class="legacy-module-page">
<div class="header">
            <div>
                <h1>Statistik Pendaftaran</h1>
                <p>Pantau data pendaftaran dan pembayaran event.</p>
            </div>

            <a href="{{ route('pendaftarans.index') }}" class="back">
                Kembali ke Pendaftaran
            </a>
        </div>

        <div class="charts">

            <div class="chart-box">
                <h3>Status Pendaftaran</h3>
                <p>Jumlah peserta berdasarkan status pendaftaran.</p>

                <div class="chart-container">
                    <canvas id="pendaftaranChart"></canvas>
                </div>
            </div>

            <div class="chart-box">
                <h3>Status Pembayaran</h3>
                <p>Perbandingan peserta yang sudah dan belum membayar.</p>

                <div class="chart-container">
                    <canvas id="pembayaranChart"></canvas>
                </div>
            </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

        const statusPendaftaran = @json($pendaftaran);
        const statusPembayaran = @json($pembayaran);

        new Chart(document.getElementById('pendaftaranChart'), {
            type: 'bar',
            data: {
                labels: statusPendaftaran.map(item => item.status_pendaftaran),
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: statusPendaftaran.map(item => item.total),
                    backgroundColor: '#4F46E5',
                    borderRadius: 8,
                    barThickness: 45
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('pembayaranChart'), {
            type: 'doughnut',
            data: {
                labels: statusPembayaran.map(item => item.status_pembayaran),
                datasets: [{
                    label: 'Jumlah Pembayaran',
                    data: statusPembayaran.map(item => item.total),
                    backgroundColor: ['#16A34A', '#F59E0B'],
                    borderWidth: 3,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    
</script>
@endpush
