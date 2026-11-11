
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-slate-900 text-white px-8 py-5">
        <h1 class="text-2xl font-bold">EventHub</h1>
        <p class="text-slate-300 text-sm">Event Management System</p>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-10">

        <!-- Welcome -->
        <div class="mb-10">
            <h2 class="text-3xl font-bold text-slate-800">
                Selamat Datang di EventHub!
            </h2>
            <p class="text-slate-500 mt-2">
                Kelola event, peserta, pendaftaran, dan presensi dalam satu platform.
            </p>
        </div>

        <!-- Statistik -->
        <h3 class="text-xl font-semibold text-slate-800 mb-5">
            Ringkasan Data
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-slate-500 text-sm">Total Events</p>
                <h2 class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $totalEvents }}
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-slate-500 text-sm">Total Peserta</p>
                <h2 class="text-3xl font-bold text-green-600 mt-2">
                    {{ $totalPeserta }}
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-slate-500 text-sm">Total Pendaftaran</p>
                <h2 class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $totalPendaftaran }}
                </h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-slate-500 text-sm">Total Presensi</p>
                <h2 class="text-3xl font-bold text-orange-600 mt-2">
                    {{ $totalPresensi }}
                </h2>
            </div>

        </div>

        <!-- Menu Manajemen -->
        <h3 class="text-xl font-semibold text-slate-800 mb-5">
            Menu Manajemen
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <a href="/events"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-3xl mb-4">📅</div>
                <h4 class="font-bold text-lg">Events</h4>
                <p class="text-sm text-slate-500 mt-2">
                    Kelola informasi dan jadwal event.
                </p>
                <p class="text-blue-600 text-sm font-semibold mt-5">
                    Buka Menu →
                </p>
            </a>

            <a href="/pesertas"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-3xl mb-4">👥</div>
                <h4 class="font-bold text-lg">Pesertas</h4>
                <p class="text-sm text-slate-500 mt-2">
                    Kelola data peserta event.
                </p>
                <p class="text-blue-600 text-sm font-semibold mt-5">
                    Buka Menu →
                </p>
            </a>

            <a href="/pendaftarans"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-3xl mb-4">📋</div>
                <h4 class="font-bold text-lg">Pendaftaran</h4>
                <p class="text-sm text-slate-500 mt-2">
                    Kelola data pendaftaran event.
                </p>
                <p class="text-blue-600 text-sm font-semibold mt-5">
                    Buka Menu →
                </p>
            </a>

            <a href="/presensis"
               class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-3xl mb-4">✅</div>
                <h4 class="font-bold text-lg">Presensi</h4>
                <p class="text-sm text-slate-500 mt-2">
                    Kelola kehadiran peserta.
                </p>
                <p class="text-blue-600 text-sm font-semibold mt-5">
                    Buka Menu →
                </p>
            </a>

        </div>

    </main>

    <footer class="text-center text-slate-400 text-sm py-6">
        © 2026 EventHub. Event Management System.
    </footer>

</body>
</html>