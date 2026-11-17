<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <style>
            body {
                font-family: DejaVu Sans, sans-serif;
                font-size: 10px;
                color: #222;
            }
            h2 {
                text-transform: capitalize;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #bbb;
                padding: 6px;
                text-align: left;
            }
            th {
                background: #eee;
            }
        </style>
    </head>
    <body>
        <h2>Data {{ $type }} · EventHub</h2>
        <table>
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ str_replace('_', ' ', ucfirst($header)) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                    <tr>
                        @foreach($headers as $header)
                            <td>{{ data_get($row, $header, '') }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
