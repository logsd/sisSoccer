@extends('template')

@section('title', 'Crear Ejecutivo')

@push('css')
@endpush

@section('content')

<style>
    #description {
        resize: none;
    }

    #description {
        resize: none;
    }

    .cuerpo {
        border: solid 3px black;
        border-radius: 10px;
        padding: 20px;
        background: #4EA93B;
        color: black;
        margin-bottom: 20px
    }

    h4 {
        text-align: center;
        padding: 4px 5px;
    }

    .buttong {
        background-color: #32fc08;
        color: black;
        padding: 8px 20px 8px 20px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
    }

    .buttonr {
        background-color: #A5D29A;
        color: black;
        padding: 8px 15px 8px 15px;
        margin-left: 10px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
    }

    .buttonr:hover,
    .buttong:hover {
        background-color: #337326;
        color: white;

    }

    .fa-check,
    .fa-arrow-left {
        padding-right: 10px;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center mb-4">Nuevo Ejecutivo</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('ejecutivos.index')}}">Ejecutivos</a> </li>
        <li class="breadcrumb-item active">Nuevo Ejecutivo</li>
    </ol>
    <div class="cuerpo">
        <form action="{{route('ejecutivos.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="dni" class="form-label">CI:</label>
                    <input type="number" name="dni" id="dni" class="form-control" value="{{old('dni')}}">
                    @error('dni')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                    @error('name')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="lastname" class="form-label">Apellido:</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="{{old('lastname')}}">
                    @error('lastname')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="address" class="form-label">Dirección:</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}">
                    @error('address')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                    @error('email')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="img_path" class="form-label">Imagen:</label>
                    <input type="file" name="img_path" id="img_path" class="form-control" accept="Image/*">
                    @error('img_path')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-12 text-center">
                    <div class="row text-center">
                        <div class="col-md-12 mb-2 mt-2">
                            <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                            <a href="{{route('ejecutivos.index')}}">
                                <button type="button" class="buttonr"><i
                                        class="fa-solid fa-arrow-left"></i>Regresar</button>
                            </a>
                            <div class="col-md-12 mb-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @push('js')

    @endpush
