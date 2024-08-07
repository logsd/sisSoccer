@extends('template')

@section('title', 'Ver Fase Campeonato')

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
        <li class="breadcrumb-item "><a href="{{route('fases.index')}}"> Fases Campeonatos</a> </li>
        <li class="breadcrumb-item "> Fase Campeonato</a> </li>
    </ol>
</div>

<h1 class="my-4 text-center m-2">Fase Campeonato</h1>
<div class="cuerpo m-3">

    <div class="card p-4">
        <div class="row mb-2">

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                    <input disabled type="text" class="form-control" value="Campeonato:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control bg-white" value="{{$fase->championship->name}}">
            </div>


            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha Inicio:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control bg-white" value=" {{\Carbon\Carbon::parse($fase->championship->start_date)->format('d-m-Y')}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha Fin:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control bg-white" value=" {{\Carbon\Carbon::parse($fase->championship->end_date)->format('d-m-Y')}}">
            </div>


            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fase:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control bg-white" value=" {{$fase->name}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fase Descripción:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control bg-white" value="{{$fase->description}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Grupo Nombre:">
                </div>
            </div>
            <div class="col-sm-8">
                @foreach ($fase->leagueGroups as $grupo)
                <input disabled type="text" class="form-control bg-white" value="{{$grupo->name}}">
                @endforeach
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Grupo Descripción:">
                </div>
            </div>
            <div class="col-sm-8">
                @foreach ($fase->leagueGroups as $grupo)
                <input disabled type="text" class="form-control bg-white" value="{{$grupo->description}}">
                @endforeach
            </div>

        </div>
    </div>

</div>
<a href="{{route('fases.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
@endsection

@push('js')

@endpush
