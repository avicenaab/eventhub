
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
</head>
<body>
<h1>Edit Event</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')

    @include('events.form')

    <button type="submit">Simpan Perubahan</button>
    <a href="{{ route('events.index') }}">Kembali</a>
</form>
</body>
</html>
