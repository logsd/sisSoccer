@extends('template')

@section('title', 'Ver Partido')

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
</style>

<div class="container-fluid px-4">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('calendarios.index')}}"> Calendario</a> </li>
    </ol>
</div>
<h1 class="my-4 text-center">Partido</h1>
<div class="container-fluid mt-4">
    <div class="container mt-5 text-center">
        <div class="card">
            <div class="card-header ">
                Detalles del Partido
            </div>
            <div class="header">
                Partido ID: {{ $calendario->id }}
            </div>
            <div class="card-body">
                @if ($calendario->championship)
                    <h5 class="card-title mb-2 text-body-secondary">Campeonato: {{ $calendario->championship->name }}</h5>
                @elseif($calendario->leaguePhase)
                    <h5 class="card-title mb-2 text-body-secondary">Campeonato:
                        {{$calendario->leaguePhase->championship->name}}</h5>
                @else
                    <h5 class="card-title mb-2 text-body-secondary">Partido Independiente</h5>
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
                    @if ($calendario->leaguePhase)
                        <strong>Fase:</strong> {{ $calendario->leaguePhase->name}}<br>
                    @else
                        <strong>Partido independiente</strong><br>
                    @endif
                    <a href="{{ route('calendarios.index') }}" class="btn btn-success mt-2">Volver</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')

@endpush
