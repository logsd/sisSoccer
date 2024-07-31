@extends('template')

@section('title', 'Visualizar Campeonato')

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
        padding: 7px 15px 7px 15px;
        border: solid 2px black;
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
        margin-left: 2%;
    }
</style>

<div class="container-fluid pt-4">

    <ol class="breadcrumb mb-8 ">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('campeonatos.index')}}">Campeonato</a> </li>
    </ol>
</div>
<div class="container">
<h1 class="mt-2 text-center mb-4">Campeonato</h1>
<div class="card m-4 p-3">
<div class="row px-10">

<h4 class="my-3 text-center">Detalles</h4>
    <div class="col-sm-6">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
            <input disabled type="text" class="form-control" value="Campeonato:">
            <input disabled type="text" class="form-control  bg-white" value="{{$campeonato->name}}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
            <input disabled type="text" class="form-control" value="Categoria:">
            <input disabled type="text" class="form-control bg-white" value=" {{$campeonato->category->name}}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Año:">
            <input disabled type="text" class="form-control bg-white" value=" {{$campeonato->year}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
            <input disabled type="text" class="form-control" value="Observación:">
            <input disabled type="text" class="form-control bg-white" value=" {{$campeonato->observation}}">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Inicio:">
            <input disabled type="text" class="form-control bg-white" value=" {{\Carbon\Carbon::parse($campeonato->start_date)->format('d-m-Y')}}">
        </div>
    </div>
    <div class="col-sm-6">
    <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Fin:">
            <input disabled type="text" class="form-control bg-white" value=" {{\Carbon\Carbon::parse($campeonato->end_date)->format('d-m-Y')}}">
        </div>
    </div>


    <div class="col-sm-6">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Desde:">
            <input disabled type="text" class="form-control bg-white" value=" {{\Carbon\Carbon::parse($campeonato->from)->format('d-m-Y')}}">
        </div>
    </div>
    <div class="col-sm-6">
    <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Fecha Hasta:">
            <input disabled type="text" class="form-control bg-white" value=" {{\Carbon\Carbon::parse($campeonato->until)->format('d-m-Y')}}">
        </div>
    </div>


    <div class="col-sm-12">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
            <input disabled type="text" class="form-control" value="Descripción:">
            <input disabled type="text" class="form-control bg-white" value=" {{$campeonato->description}}">
        </div>
    </div>

</div>
</div>
<a href="{{route('campeonatos.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
</div>

@endsection

@push('js')

@endpush
