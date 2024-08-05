@extends('template')

@section('title', 'Ver Empleado')

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
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('empleados.index')}}">Empleados</a> </li>
        <li class="breadcrumb-item ">Empleado</li>
    </ol>

</div>
<h1 class="mt-2 text-center mb-4">Empleado</h1>
<div class="card m-4 p-3">
<div class="row px-10">

            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                    <input disabled type="text" class="form-control" value="Nombre">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->name}}">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                    <input disabled type="text" class="form-control" value="Apellido">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->last_name}}">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha N.">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->birth_date}}">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                    <input disabled type="text" class="form-control" value="Estado C.">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->civilStatus->name}}">
                </div>
            </div>

            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input disabled type="text" class="form-control w-6" value="Email">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->email}}">
                </div>
            </div>


            <div class="col-sm-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                    <input disabled type="text" class="form-control " value="Dirección">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->direction}}">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i></span>
                    <input disabled type="text" class="form-control" value="Provincia">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->province->name}}">
                </div>
            </div>





            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-users-gear"></i></span>
                    <input disabled type="text" class="form-control" value="Posición">
                    <input disabled type="text" class="form-control bg-white" value="{{$empleado->position->name}}">
                </div>
            </div>

        </div>
    </div>
    <a href="{{route('empleados.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
</div>
</div>
</div>

@endsection

@push('js')

@endpush
