<!DOCTYPE html>
<html>

<head>
    <title>Carnets de Jugadores</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
            width: 45%;
            flex: 1 0 45%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .card p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">

        @foreach($jugadores as $player)
        <div class="card">
        <img src="{{ public_path('storage/jugadores/' . $player->img_url) }}" alt="{{$player->name}}">
            <p><strong>Cod:</strong> L{{ sprintf('%04d', $player->id) }}</p>
            <p><strong>Cédula:</strong> {{ $player->dni }}</p>
            <p><strong>Apellidos:</strong> {{ $player->last_name }}</p>
            <p><strong>Nombres:</strong> {{ $player->name }}</p>
            <p><strong>F. Nac:</strong> {{ \Carbon\Carbon::parse($player->birthday)->format('d-m-Y') }}</p>
            <p><strong>Parroquia:</strong> {{ $player->province->name }}</p>
            <p><strong>Categoría:</strong> {{ $player->category->name }}</p>
            <p><strong>Juvenil:</strong> {{ $player->youth ? 'Sí' : 'No' }}</p>
            <p><strong>Refuerzo:</strong> {{ $player->booster ? 'Sí' : 'No' }}</p>
            <p><strong>Sexo:</strong> {{ $player->sexo ? 'Hombre' : 'Mujer'}}</p>
            <p><strong>Equipo:</strong> {{ $player->team->name }}</p>
        </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>