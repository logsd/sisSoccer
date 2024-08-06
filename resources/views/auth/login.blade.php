<head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
            flex-direction: column;
        }


        .left {
            background-color: #1A320F;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            flex: 1;
        }


        .right {
            background-color: #4caf50;
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 5;
        }

        form {
            width: 100%;
            max-width: 500px;
        }

        form h2 {
            margin-bottom: 50px;
            color: white;
            text-align: center;
        }

        .usuario img {
            width: 25%;
            margin: 0 auto;
            display: block;
            margin-top: -20%;
            margin-bottom: 10%;

        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .input-group input {
            width: 100%;
            padding: 20px;
            border: none;
            border-bottom: 1px solid #A8A6A7;
            border-radius: 5px 5px 0 0;
            background-color: transparent;
            color: white;
            font-size: 16px;
            outline: none;
            font-family: Vegur, 'PT Sans', Verdana, sans-serif;

        }

        .input-group input::placeholder {
            color: white;
            opacity: 1;
        }

        .input-group input:focus {
            outline: none;
            box-shadow: none;
            background-color: transparent;
            /* Asegúrate de que el fondo no cambie */
        }



        button {
            width: 30%;
            padding: 10px;
            background-color: white;
            border: none;
            border-radius: 17PX;
            color: #4EA93B;
            font-size: 16px;
            cursor: pointer;
            margin: 0 auto;
            display: block;
            margin-bottom: -50px;
        }


        button:hover {
            background-color: #2e7d32;
        }

        .login {
            margin-top: 50px
        }

        @media (min-width: 600px) {
            .container {
                flex-direction: row;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="logo">
                <img src="{{ asset('img/logo2.jpeg') }}" alt="Descripción de la imagen">
            </div>
            @if ($errors->any())
            @foreach ($errors->all() as $item)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{$item}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
            @endif
        </div>
        
        <div class="right">
            <form action="/login" method="post">
                @csrf
                <div class="usuario">
                    <img src="{{ asset('img/image.png') }}" alt="Descripción de la imagen">
                </div>
                <h2>Iniciar Sesión</h2>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="login"> <strong> LOGIN</strong></button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>