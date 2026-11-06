<!DOCTYPE html>
<html>
<head>
    <title>Statistik EventHub</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .chart-box {
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Dashboard Statistik EventHub</h2>

    <div class="chart-box">
        <h3>Grafik Status Pendaftaran</h3>
        <canvas id="pendaftaranChart"></canvas>
    </div>

    <div class="chart-box">
        <h3>Grafik Status Pembayaran</h3>
        <canvas id="pembayaranChart"></canvas>
    </div>

</div>
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
                backgroundColor: '#4F46E5'
            }]
        },
        options: {
            responsive: true,
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
                backgroundColor: ['#16A34A', '#F59E0B', '#DC2626']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>
</html>