@extends('template')

@section('title', 'Ver Partido')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ver Partido</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('calendarios.index')}}"> Calendario</a> </li>
    </ol>
</div>
<div class="container-fluid mt-4">
    <div class="container mt-5 text-center bg-success">
        <div class="card">
            <div class="card-header text-bg-dark">
                Detalles del Partido
            </div>
            <div class="card-header">
                Partido ID: {{ $calendario->id }}
            </div>
            <div class="card-body">
                @if ($calendario->championship)
                <h5 class="card-title mb-2 text-body-secondary">Campeonato: {{ $calendario->championship->name }}</h5>
                @else
                <h5 class="card-title mb-2 text-body-secondary">Campeonato: {{$calendario->leaguePhase->championship->name}}</h5>
                @endif
                <div class="row mt-3">
                    <div class="col-md-5">
                        <h5 class="card-title">Equipo Local:</h5>
                        <p class="card-text">{{ $calendario->teamHome->name }}</p>
                    </div>
                    <div class="col-md-2">
                        <h5 class="card-title">V.S</h5>
                    </div>
                    <div class="col-md-5">
                        <h5 class="card-title">Equipo Visitante:</h5>
                        <p class="card-text">{{ $calendario->teamAway->name }}</p>
                    </div>
                </div>
                <div class="blockquote-footer mt-2 ">
                    <strong>Fecha:</strong> {{\Carbon\Carbon::parse($calendario->date)->format('d-m-Y')}}<br>

                    <strong>Hora:</strong> {{\Carbon\Carbon::parse($calendario->time)->format('H:i') . ' H'}}<br>

                    <strong>Estado:</strong> {{ $calendario->status }}<br>
                    <strong>Fase:</strong> {{ $calendario->leaguePhase->name}}<br>
                    <a href="{{ route('calendarios.index') }}" class="btn btn-primary mt-2">Volver</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')

@endpush