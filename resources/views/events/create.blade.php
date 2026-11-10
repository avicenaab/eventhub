
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Event</title>
</head>
<body>
<h1>Tambah Event</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('events.store') }}" method="POST">
    @csrf

    @include('events.form')

    <button type="submit">Simpan Event</button>
    <a href="{{ route('events.index') }}">Kembali</a>
</form>
</body>
</html>
