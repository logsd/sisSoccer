@extends('template')

@section('title', 'Panel')

@push('css')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


<style>
    *{
        font-family: "Poppins", sans-serif;
        font-style: italic;
    }
    .text-center {
        text-align: center;
     }

    .contenedor {
    display: flex;
    flex-wrap: wrap;
    justify-content: 5px space-between; /* Espacio entre las tarjetas */
    gap: 35px;
    margin: 0 auto;
    max-width: 1200px; /* Ajusta el ancho máximo según sea necesario */
    padding: 20px;
}

.tarjeta {
    flex: 1 1 calc(50% - 25px) ;
    width: 500px;
    height: 250px;
    border: 3px solid #4EA93B;
    border-radius: 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    margin: 0 auto;
    text-align: left; /* Cambiado a left para alinear el texto a la izquierda */
    font-family: Arial, sans-serif;
    display: flex; /* Utiliza Flexbox */
    flex-direction: row; /* Dirección en fila */
    align-items: center; /* Alinea verticalmente en el centro */
    justify-content: space-between; /* Espacio entre los elementos */
    padding: 10px 30px;

}

.imagen {
    height: 90%; /* Asegura que la imagen tome toda la altura del contenedor */
    width: 60%; /* Ajusta el ancho según sea necesario */
    margin-top: -20px;
    overflow: hidden;
    position: relative;
}

.imagen img {
    width:100%; /* Ajusta el ancho de la imagen */
    height: 100%;
    object-fit: cover;
    position: absolute;
}

.contenido {
    text-align: center;
    width: 55%; /* Ajusta el ancho del contenido */
    box-sizing: border-box; /* Incluye el padding en el ancho y alto del contenedor */
}

h1 {
    font-size: 30px;
    margin-bottom: 30px;
    font-weight: bold;
}

a {
    font-size: 16px;
    line-height: 1.5;
    display: block; /* Asegura que el enlace se muestre como bloque */
}


</style>
@endpush

@section('content')
                    <div class="container-fluid px-4">
                       <u><b> <h1 class="mt-4 text-center">Bienvenidos....</h1> </b></u>
                    </div>
        <div class="contenedor">
                    <div class="tarjeta">
                        <div class="imagen">
                             <img src="{{ asset('img/balon.png') }}" alt="Descripción de la imagen">
                        </div>
                            <br>
                        <div class="contenido">
                            <h1> Campeonatos</h1>
                            <a href="#">Campeonato</a>
                            <br>
                            <a href="{{route('categorias.index')}}">Categoria</a>
                         </div>
                    </div>


                    <div class="tarjeta">
                        <div class="imagen">
                             <img src="{{ asset('img/consultas.png') }}" alt="Descripción de la imagen">
                        </div>
                            <br>
                        <div class="contenido">
                            <h1>Consultas</h1>
                            <a href="#">Equipos en Campeonatos</a>
                            <br>
                            <a href="{{route('categorias.index')}}">Jugadores en Campeonatos</a>
                         </div>
                    </div>

                    <div class="tarjeta">
                        <div class="imagen">
                             <img src="{{ asset('img/club.png') }}" alt="Descripción de la imagen">
                        </div>
                            <br>
                        <div class="contenido">
                            <h1>Clubes</h1>
                            <a href="#">Clubs</a>
                            <a href="{{route('categorias.index')}}">Directivos</a>
                            <a href="{{route('categorias.index')}}">Directivos Club</a>
                            <a href="{{route('categorias.index')}}">Equipos</a>
                            <a href="{{route('categorias.index')}}">Jugadores</a>
                         </div>
                    </div>

                    <div class="tarjeta">
                        <div class="imagen">
                             <img src="{{ asset('img/jugadores.png') }}" alt="Descripción de la imagen">
                        </div>
                            <br>
                        <div class="contenido">
                            <h1>Jugadores</h1>
                            <a href="{{route('categorias.index')}}">Listado de Jugadores</a>
                         </div>
                    </div>
                    <div class="tarjeta">
                        <div class="imagen">
                             <img src="{{ asset('img/parametros.png') }}" alt="Descripción de la imagen">
                        </div>
                            <br>
                        <div class="contenido">
                            <h1>Parametros del Sistema</h1>
                            <a href="#">Parametros Generales</a>
                         </div>
                    </div>

                    <div class="tarjeta">
                        <div class="imagen">
                             <img src="{{ asset('img/calendario.png') }}" alt="Descripción de la imagen">
                        </div>
                            <br>
                        <div class="contenido">
                            <h1>Calendario</h1>
                            <a href="#">Lista de Calendarios</a>
                         </div>
                    </div>
        </div>

@endsection

@push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
