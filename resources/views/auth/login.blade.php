
<head>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <STYle>
        body {
    margin: 0;
    font-family: ;
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
    flex: 1 ;
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
    max-width:500px;
}

form h2 {
    margin-bottom: 50px;
    color: white;
    text-align: center;
}

.usuario img{
    width: 25%;
    margin: 0 auto;
    display: block;
    margin-top:-20%;
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
    background-color: transparent; /* Asegúrate de que el fondo no cambie */
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

.login{
    margin-top: 50px
}

@media (min-width: 600px) {
    .container {
        flex-direction: row;
    }
}

    </STYle>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="logo">
            <img src="{{ asset('img/logo2.jpeg') }}" alt="Descripción de la imagen">
            </div>
        </div>
        <div class="right">
            <form >
                <div class="usuario">
                <img src="{{ asset('img/image.png') }}" alt="Descripción de la imagen"></div>
                <h2>Iniciar Sesión</h2>
                <div class="input-group">
                    <input type="text" id="username" name="username" required placeholder="Username">
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" required placeholder="Password">
                </div>
                <button type="submit"  class="login"> <strong> LOGIN</strong></button>
            </form>
        </div>
    </div>
</body>
</html>
