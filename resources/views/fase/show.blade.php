@extends('template')

@section('title', 'Ver Fase Campeonato')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ver Fase Campeonato</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('fases.index')}}"> Fases Campeonatos</a> </li>
    </ol>
</div>
<div class="container w-100 ">

    <div class="card p-2">
        <div class="row mb-2">

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                    <input disabled type="text" class="form-control" value="Campeonato:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$fase->championship->name}}">
            </div>


            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha Inicio:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{\Carbon\Carbon::parse($fase->championship->start_date)->format('d-m-Y')}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha Fin:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{\Carbon\Carbon::parse($fase->championship->end_date)->format('d-m-Y')}}">
            </div>


            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fase:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{$fase->name}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fase Descripcion:">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$fase->description}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Grupo Nombre:">
                </div>
            </div>
            <div class="col-sm-8">
                @foreach ($fase->leagueGroups as $grupo)
                <input disabled type="text" class="form-control" value="{{$grupo->name}}">
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
                <input disabled type="text" class="form-control" value="{{$grupo->description}}">
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')

@endpush