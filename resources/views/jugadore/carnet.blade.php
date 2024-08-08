<!DOCTYPE html>
<html>

<head>
    <title>Carnets de Jugadores</title>
    <style>
        .card img.photo {
            width: 160px;
            height: 170px;
            float: left;
            margin-right: 15px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .card .title {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
            border-bottom: solid 2px #4EA93B ;
        }

        .card-header {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            font-size: 18px;
            border-bottom: solid 2px #1A320F;
            color:#4EA93B;;
        }

        .card .info {
            font-size: 12px;
            line-height: 1.5;
            margin-top: 5px;
            margin-left: 180px;
        }


        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            border: 2px solid #4EA93B;
            padding: 10px;
            margin: 5px;
            width: 55%;
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



        .card label {
            margin-right: 100px;
            color: #4EA93B;
        }

        td{
            font-size: 15px;
        }


        .equipo{
            color:brown;
            margin-top: 5px;
        }

        .tittle{
            border-top: solid 2px  #4EA93B ;
            padding-top: 5px;
            margin-top: -5px;
        }

    </style>
</head>

<body>
    <div class="container">

        @foreach($jugadores as $player)
            <div class="card">
                <div class="card-header"><strong>{{ $player->league->name }}</strong>
                </div>
                <div class="tittle"><label><strong>Cod:</strong> L{{ sprintf('%04d', $player->id) }}</label>
                    <strong>Cédula:</strong> {{ $player->dni }}
                </div>


                <img class="photo" src="{{ public_path('storage/jugadores/' . $player->img_url) }}"
                    alt="{{ $player->name }}">
        

                <div class="info">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Apellidos:</strong></td>
                                <td>{{ $player->last_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nombres:</strong></td>
                                <td>{{ $player->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>F. Nac:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($player->birthday)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Parroquia:</strong></td>
                                <td>{{ $player->province->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Juvenil:</strong></td>
                                <td> {{ $player->youth ? 'Sí' : 'No' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Refuerzo:</strong></td>
                                <td>{{ $player->booster ? 'Sí' : 'No' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sexo:</strong></td>
                                <td> {{ $player->sexo ? 'Hombre' : 'Mujer'}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="equipo"><strong>Equipo:</strong>
                {{ $player->team->name }}</div>

            </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
