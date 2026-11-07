<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Presensi') - EventHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            color: #1e293b;
        }

        nav {
            background: #172554;
            padding: 18px 7%;
            color: white;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .content {
            background: white;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 26px;
        }

        p {
            line-height: 1.6;
        }

        a {
            color: #2563eb;
        }

        .btn,
        button {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 14px;
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

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f1f5f9;
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

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
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            background: white;
        }

        input:focus,
        select:focus {
            outline: 2px solid #bfdbfe;
            border-color: #2563eb;
        }

        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .search-form input {
            flex: 2;
            min-width: 200px;
        }

        .search-form select {
            flex: 1;
            min-width: 160px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
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

        .empty-state {
            padding: 30px;
            text-align: center;
            color: #64748b;
        }

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

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        @media (max-width: 600px) {
            main {
                margin: 20px auto;
                padding: 0 12px;
            }

            .content {
                padding: 18px;
            }

            h1 {
                font-size: 22px;
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

    <nav>
        <a href="{{ route('presensis.index') }}">EventHub</a>
    </nav>

    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>

</body>
</html>