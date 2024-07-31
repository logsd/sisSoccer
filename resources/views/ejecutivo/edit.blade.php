@extends('template')

@section('title', 'Editar Ejecutivo')

@push('css')
@endpush

@section('content')

<style>
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
        padding: 8px 15px 8px 15px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
    }

    .buttonr {
        background-color: #d11500;
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
    <h1 class="mt-4 text-center mb-3">Editar Ejecutivos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('ejecutivos.index')}}">Ejecutivos</a> </li>
        <li class="breadcrumb-item active">Editar Ejecutivo</li>
    </ol>

    <div class="cuerpo">
        <form action="{{route('ejecutivos.update', ['ejecutivo' => $ejecutivo])}}" method="post"
            enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="number" name="dni" id="dni" class="form-control"
                        value="{{old('dni', $ejecutivo->dni)}}">
                    @error('dni')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{old('name', $ejecutivo->name)}}">
                    @error('name')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="lastname" class="form-label">Apellido:</label>
                    <input type="text" name="lastname" id="lastname" class="form-control"
                        value="{{old('lastname', $ejecutivo->lastname)}}">
                    @error('lastname')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{old('address', $ejecutivo->address)}}">
                    @error('address')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{old('email', $ejecutivo->email)}}">
                    @error('email')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="img_path" class="form-label">Imagen:</label>
                    @if($ejecutivo->img_path)
                        <div class="img-container">
                            <img src="{{ Storage::url('public/ejecutivos/' . $ejecutivo->img_path)}}"
                                alt="{{$ejecutivo->name}}" class="img-fluid img-thumbnail border border-4 rounded">
                        </div>
                    @endif
                    <br>
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
                                        class="fa-solid fa-arrow-left"></i>Cancelar</button>
                            </a>
                            <div class="col-md-12 mb-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
