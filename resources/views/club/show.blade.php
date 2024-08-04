@extends('template')

@section('title', 'Visualizar club')

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
        <li class="breadcrumb-item "><a href="{{route('clubs.index')}}">club</a> </li>
    </ol>
</div>
<div class="container">
<h1 class="mt-2 text-center mb-4">Club</h1>
<div class="card m-4 p-3">
<div class="row px-10">

<h4 class="my-3 text-center">Detalles</h4>
    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-people-group"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->name}}">
                                                    </div>

    </div>

    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->trade_name}}">
                                                    </div>
    </div>

    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->reason_social}}">
                                                    </div>
    </div>
    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->ruc}}">
                                                    </div>

    </div>

    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->direction}}">
                                                    </div>

    </div>
    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->email}}">
                                                    </div>
    </div>


    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->date_constion}}">
                                                    </div>
    </div>
    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->direction_web}}">
                                                    </div>
    </div>

    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->slogan}}">
                                                    </div>
    </div>

    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->description}}">
                                                    </div>
    </div>

    <div class="col-sm-6">
    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->parish}}">
                                                    </div>
    </div>

    <div class="col-sm-12">
    <div class="row mb-3">
                                                        <label class="fw-bolder mb-3">Imagen:</label>
                                                        <div>
                                                            @if ($club->logo != null)
                                                                <img src="{{ Storage::url('public/clubs/' . $club->logo)}}"
                                                                    alt="{{$club->name}}"
                                                                    class="img-fluid img-thumbnail border border-4 rounded">
                                                            @else
                                                                <img src="" alt="{{$club->name}}">
                                                            @endif
                                                        </div>
                                                    </div>
    </div>


    <div class="col-sm-12">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
            <input disabled type="text" class="form-control" value="Descripción:">
            <input disabled type="text" class="form-control bg-white" value=" {{$club->description}}">
        </div>
    </div>

</div>
</div>
<a href="{{route('clubs.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
</div>

@endsection

@push('js')

@endpush
