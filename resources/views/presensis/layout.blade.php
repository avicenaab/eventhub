<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Presensi') - EventHub</title>

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

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #172554;
            color: white;
            padding: 30px 20px;
            flex-shrink: 0;
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
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        /* MAIN CONTENT */
        .main {
            flex: 1;
            min-width: 0;
            padding: 40px;
        }

        .content {
            width: 100%;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
            color: #263248;
        }

        h2, h3 {
            color: #263248;
        }

        p {
            line-height: 1.6;
            color: #64748b;
        }

        a {
            color: #2563eb;
        }

        /* BUTTON */
        .btn,
        button {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover,
        button:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            background: #64748b;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-success {
            background: #15803d;
        }

        .back {
            display: inline-block;
            margin: 15px 0;
            text-decoration: none;
        }

        /* TABLE */
        .table-wrap {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            background: #172554;
            color: white;
            padding: 14px 12px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: middle;
            font-size: 13px;
        }

        tr:hover td {
            background: #f8fafc;
        }

        /* FORM */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #bfdbfe;
            border-color: #2563eb;
        }

        /* SEARCH */
        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .search-form input {
            flex: 2;
            min-width: 200px;
        }

        .search-form select {
            flex: 1;
            min-width: 160px;
        }

        /* ALERT */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin: 18px 0;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* EMPTY STATE */
        .empty-state {
            padding: 30px;
            text-align: center;
            color: #64748b;
        }

        /* PAGINATION */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            font-size: 14px;
        }

        /* ACTIONS */
        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */
        @media (max-width: 700px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 20px;
            }

            .brand {
                margin-bottom: 20px;
            }

            .main {
                padding: 20px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form input,
            .search-form select {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">EventHub</div>

        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('events.index') }}">Events</a>
        <a href="{{ route('pesertas.index') }}">Peserta</a>
        <a href="{{ route('pendaftarans.index') }}">Pendaftaran</a>
        <a href="{{ route('presensis.index') }}" class="active">Presensi</a>
    </aside>

    <main class="main">
        <div class="content">
            @yield('content')
        </div>
    </main>

</body>
</html>