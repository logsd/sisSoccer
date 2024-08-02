@extends('template')

@section('title', 'Ver Empleado')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 ">Ver Empleado</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('empleados.index')}}">Empleado</a> </li>
    </ol>
</div>
<div class="container w-100">

    <div class="card p-2">
        <div class="row mb-2">

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                    <input disabled type="text" class="form-control" value="Nombre">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->name}}">
            </div>


            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                    <input disabled type="text" class="form-control" value="Apellido">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->last_name}}">
            </div>


            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input disabled type="text" class="form-control" value="Email">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->email}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha N.">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->birth_date}}">
            </div>
            

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                    <input disabled type="text" class="form-control" value="Dirección">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->direction}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i></span>
                    <input disabled type="text" class="form-control" value="Provincia">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->province->name}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                    <input disabled type="text" class="form-control" value="Estado C.">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->civilStatus->name}}">
            </div>

            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-users-gear"></i></span>
                    <input disabled type="text" class="form-control" value="Posición">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{$empleado->position->name}}">
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('js')

@endpush