<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik EventHub</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        .sidebar {
            width: 240px;
            background: #172554;
            color: white;
            padding: 30px 20px;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
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

            .sidebar {
                width: 100%;
            }

            .main {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">EventHub</div>

        <a href="{{ url('/') }}">Dashboard</a>
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('pesertas.index') }}">Peserta</a>
        <a href="{{ route('pendaftarans.index') }}" class="active">Pendaftaran</a>
        <a href="{{ route('presensis.index') }}">Presensi</a>
    </aside>

    <main class="main">

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

    </main>

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

</body>
</html>