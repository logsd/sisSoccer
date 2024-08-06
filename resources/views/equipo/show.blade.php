@extends('template')

@section('title', 'Ver Equipo')

@push('css')

@endpush

@section('content')
<style>
    .card{
        background-color: #4EA93B;
    }


    .buttonr {
        background-color: #A5D29A;
        color: black;
        padding: 7px 25px 7px 25px;
        border: solid 2px black;
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
        margin-left: 2%;
    }

    .fa-arrow-left{
        margin-right: 10px;
    }
</style>


<div class="container-fluid px-4">

    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('equipos.index')}}">Equipos</a> </li>
        <li class="breadcrumb-item ">Equipo</li>
    </ol>
    <h1 class="my-4 text-center">Equipo</h1>
</div>
<div class="container">

    <div class="card p-2 mb-3">
        <div class="row m-2">

            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-people-group"></i></span>
                    <input disabled type="text" class="form-control" value="Equipo:">
                    <input disabled type="text" class="form-control bg-white" value="{{$equipo->name}}">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-venus-mars"></i></span>
                    <input disabled type="text" class="form-control" value="Genero:">
                    @if ($equipo->gender == 1)
                        <input disabled type="text" class="form-control bg-white" value="Varonil">
                    @else
                        <input disabled type="text" class="form-control bg-white" value="Femenil">
                    @endif
                </div>
            </div>


            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Grupo">
                    <input disabled type="text" class="form-control bg-white" value="{{$equipo->cluster}}">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                    <input disabled type="text" class="form-control" value="N* Jugadores">
                    <input disabled type="text" class="form-control bg-white" value=" {{$equipo->player_number}}">
                </div>
            </div>


            <div class="col-sm-12">
                <div class="input-group ">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control " value="Descripción">
                </div>
            </div>
            <div class="col-sm-12 mb-3">
                <input disabled type="text" class="form-control bg-white" value=" {{$equipo->description}}">
            </div>

            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Campeonato">
                    <input disabled type="text" class="form-control bg-white"
                        value="{{$equipo->championship->name ?? ''}}">
                </div>
            </div>



            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                    <input disabled type="text" class="form-control" value="Categoria:">
                    <input disabled type="text" class="form-control" value=" {{$equipo->category->name ?? ''}}">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                    <input disabled type="text" class="form-control" value="Club:">
                    <input disabled type="text" class="form-control bg-white" value=" {{$equipo->club->name ?? ''}}">
                </div>
            </div>



            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
                    <input disabled type="text" class="form-control" value="Puntos:">
                    <input disabled type="text" class="form-control bg-white" value=" {{$equipo->points ?? ''}}">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
                    <input disabled type="text" class="form-control" value="Goles a favor:">
                    <input disabled type="text" class="form-control bg-white" value=" {{$equipo->gol_afa ?? ''}}">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
                    <input disabled type="text" class="form-control" value="Goles en contra:">
                    <input disabled type="text" class="form-control bg-white" value=" {{$equipo->gol_enc ?? ''}}">
                </div>
            </div>

        </div>
    </div>

</div>

<a href="{{route('equipos.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
@endsection

@push('js')

@endpush
