@extends('template')

@section('title', 'Ver Jugador')

@push('css')

@endpush

@section('content')


<style>
    .card-header {
        background-color: #1A320F;
        color: white;
    }

    .header {
        background-color: #4EA93B;

    }


    .buttonr {
        background-color: #A5D29A;
        color: black;
        padding: 7px 15px 7px 15px;
        border: solid 2px black;
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
        margin-left: 2%;

    }
</style>

<div class="container-fluid px-4">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('jugadores.index')}}"> Jugadores</a> </li>
        <li class="breadcrumb-item ">Jugador</li>
    </ol>
</div>
<h1 class=" text-center">Jugador</h1>
<div class="container-fluid mt-2 border-2 border-success">
    <div class="container mt-5 text-center ">
        <div class="card">
            <div class="card-header bg-black">
                Detalles del Jugador
            </div>
            <div class="header text-black">
                Cedula: {{ $jugadore->dni }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($jugadore->img_url != null)
                        <img src="{{ Storage::url('public/jugadores/'. $jugadore->img_url)}}" alt="{{$jugadore->name}}" class="img-fluid">
                        @else
                        <img src="" alt="{{$jugadore->name}}">
                        @endif
                    </div>
                    <div class="col-md-8 text-start">
                        <h5 class="card-title mb-2 text-body-secondary">Nombre: {{ $jugadore->name }} {{$jugadore->last_name}}</h5>

                        <label class="mb-2 mr-4"><strong>Fecha Nacimiento:</strong> {{\Carbon\Carbon::parse($jugadore->birthday)->format('d-m-Y')}}</label><br>

                        <label class="mb-2 "><strong>Fecha Ingreso:</strong> {{\Carbon\Carbon::parse($jugadore->f_from)->format('d-m-Y')}}<br></label>

                        <label class="mb-2 mx-5"><strong>Fecha Salida:</strong> {{\Carbon\Carbon::parse($jugadore->f_until)->format('d-m-Y')}}</label><br>

                        <label class="mb-2"><strong>Sexo:</strong>
                        @if ($jugadore->sexo == 1)
                        Hombre <br>
                        @else
                        Mujer </label><br>
                        @endif

                        <label class="mb-2"><strong>Posición:</strong> {{ $jugadore->position }}</label><br>

                        <strong>Propio:</strong>
                        @if ($jugadore->own == 1)
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                        <br>
                        @else
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
                        <br>
                        @endif

                        <strong>Refuerzo:</strong>
                        @if ($jugadore->booster == 1)
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                        <br>
                        @else
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
                        <br>
                        @endif

                        <strong>Juvenil:</strong>
                        @if ($jugadore->youth == 1)
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                        <br>
                        @else
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
                        <br>
                        @endif

                        <strong>Certificado:</strong>
                        @if ($jugadore->certified == 1)
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                        <br>
                        @else
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
                        <br>
                        @endif


                        <label class="my-2"><strong>Dirección:</strong> {{ $jugadore->direction}}</label><br>

                        <label class="mb-2"><strong>Observación:</strong> {{ $jugadore->observation}}</label><br>

                    </div>
                    <div class="blockquote-footer mt-2 text-end">
                        <strong>Provincia:</strong> {{ $jugadore->province->name}}<br>

                        <strong>Equipo:</strong> {{ $jugadore->team->name}}<br>

                        <strong>Liga:</strong> {{ $jugadore->league->name}}<br>

                        <strong>Categoría:</strong> {{ $jugadore->category->name}}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<a href="{{route('jugadores.index')}}">
                                    <button type="button" class="buttonr mt-2"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
@endsection

@push('js')

@endpush
