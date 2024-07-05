@extends('template')

@section('title', 'Ver Campeonato')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ver Campeonato</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('campeonatos.index')}}">Campeonatos</a> </li>
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
        <input disabled type="text" class="form-control" value="{{$campeonato->name}}">
    </div>

    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Año:">
        </div>
    </div>
    <div class="col-sm-8">
        <input disabled type="text" class="form-control" value=" {{$campeonato->year}}">
    </div>

    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Inicio:">
        </div>
    </div>
    <div class="col-sm-8">
        <input disabled type="text" class="form-control" value=" {{\Carbon\Carbon::parse($campeonato->start_date)->format('d-m-Y')}}">
    </div>

    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Fin:">
        </div>
    </div>
    <div class="col-sm-8">
        <input disabled type="text" class="form-control" value=" {{\Carbon\Carbon::parse($campeonato->end_date)->format('d-m-Y')}}">
    </div>

    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Desde:">
        </div>
    </div>
    <div class="col-sm-8">
        <input disabled type="text" class="form-control" value=" {{\Carbon\Carbon::parse($campeonato->from)->format('d-m-Y')}}">
    </div>

    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Hasta:">
        </div>
    </div>
    <div class="col-sm-8">
        <input disabled type="text" class="form-control" value=" {{\Carbon\Carbon::parse($campeonato->until)->format('d-m-Y')}}">
    </div>


    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
            <input disabled type="text" class="form-control" value="Descripción:">
        </div>
    </div>
    <div class="col-sm-8">
        <input disabled type="text" class="form-control" value=" {{$campeonato->description}}">
    </div>

    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
            <input disabled type="text" class="form-control" value="Observación:">
        </div>
    </div>
    <div class="col-sm-8">
        <input disabled type="text" class="form-control" value=" {{$campeonato->observation}}">
    </div>


    <div class="col-sm-4">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
            <input disabled type="text" class="form-control" value="Categoria:">
        </div>
    </div>
    <div class="col-sm-3">
        <input disabled type="text" class="form-control" value=" {{$campeonato->category->name}}">
    </div>


</div>
</div>
</div>
@endsection

@push('js')

@endpush