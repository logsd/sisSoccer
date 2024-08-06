@extends('template')

@section('title', 'Ver Jugador')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ver Jugador</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('jugadores.index')}}"> Jugadores</a> </li>
    </ol>
</div>
<div class="container-fluid mt-4">
    <div class="container mt-5 text-center bg-success">
        <div class="card">
            <div class="card-header text-bg-dark">
                Detalles del Jugador
            </div>
            <div class="card-header">
                Cedula Jugador: {{ $jugadore->dni }}
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
                    <div class="col-md-8">
                        <h5 class="card-title mb-2 text-body-secondary">Nombre: {{ $jugadore->name }} {{$jugadore->last_name}}</h5>

                        <strong>Fecha Nacimiento:</strong> {{\Carbon\Carbon::parse($jugadore->birthday)->format('d-m-Y')}}<br>

                        <strong>Fecha Ingreso:</strong> {{\Carbon\Carbon::parse($jugadore->f_from)->format('d-m-Y')}}<br>

                        <strong>Fecha Salida:</strong> {{\Carbon\Carbon::parse($jugadore->f_until)->format('d-m-Y')}}<br>

                        <strong>Sexo:</strong>
                        @if ($jugadore->sexo == 1)
                        Hombre <br>
                        @else
                        Mujer <br>
                        @endif

                        <strong>Posición:</strong> {{ $jugadore->position }}<br>

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


                        <strong>Dirección:</strong> {{ $jugadore->direction}}<br>

                        <strong>Observación:</strong> {{ $jugadore->observation}}<br>

                    </div>
                    <div class="blockquote-footer mt-2 ">
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

@endsection

@push('js')

@endpush