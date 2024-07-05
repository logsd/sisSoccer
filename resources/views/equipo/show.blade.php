@extends('template')

@section('title', 'Ver Equipo')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ver Equipo</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('equipos.index')}}">Equipos</a> </li>
    </ol>
</div>
<div class="container w-100 ">

    <div class="card p-2">
        <div class="row mb-2">

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-people-group"></i></span>
                    <input disabled type="text" class="form-control" value="Equipo:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$equipo->name}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-venus-mars"></i></span>
                    <input disabled type="text" class="form-control" value="Genero:">
                </div>
            </div>
            <div class="col-sm-8">
                @if ($equipo->gender == 1)
                <input disabled type="text" class="form-control" value="Varonil">
                @else
                <input disabled type="text" class="form-control" value="Femenil">
                @endif
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Grupo">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$equipo->cluster}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                    <input disabled type="text" class="form-control" value="N* Jugadores">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{$equipo->player_number}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Descripción">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{$equipo->description}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Campeonato">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$equipo->championship->name ?? ''}}">
            </div>


            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                    <input disabled type="text" class="form-control" value="Categoria:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{$equipo->category->name ?? ''}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                    <input disabled type="text" class="form-control" value="Club:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{$equipo->club->name ?? ''}}">
            </div>


            <div class="col-sm-2">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
                    <input disabled type="text" class="form-control" value="Puntos:">
                </div>
            </div>
            <div class="col-sm-2">
                <input disabled type="text" class="form-control" value=" {{$equipo->points ?? ''}}">
            </div>

            <div class="col-sm-2">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control" value="Goles a favor:">
                </div>
            </div>
            <div class="col-sm-2">
                <input disabled type="text" class="form-control" value=" {{$equipo->gol_afa ?? ''}}">
            </div>

            <div class="col-sm-2">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control" value="Goles en contra:">
                </div>
            </div>
            <div class="col-sm-2">
                <input disabled type="text" class="form-control" value=" {{$equipo->gol_enc ?? ''}}">
            </div>


        </div>
    </div>
</div>
@endsection

@push('js')

@endpush