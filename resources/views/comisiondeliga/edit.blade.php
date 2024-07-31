@extends('template')

@section('title', 'Editar Comisionde de Ligas')

@push('css')
<style>
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
        background-color:#A5D29A;
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
@endpush

@section('content')
<div class="container-fluid px-4">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('comisiondeligas.index')}}">Comision de Liga</a> </li>
        <li class="breadcrumb-item active">Actulizar Comision de Liga</li>
    </ol>
    <h1 class="my-4 text-center">Actulizar Comision de Liga</h1>
    <div class="cuerpo">
        <form action="{{route('comisiondeligas.update', ['comisiondeliga' => $comisiondeliga])}}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{old('name', $comisiondeliga->name)}}">
                    @error('name')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="short_name" class="form-label">Nombre Corto:</label>
                    <input type="text" name="short_name" id="short_name" class="form-control"
                        value="{{old('short_name', $comisiondeliga->short_name)}}">
                    @error('short_name')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="role" class="form-label">Rol:</label>
                    <input type="text" name="role" id="role" class="form-control"
                        value="{{old('role', $comisiondeliga->role)}}">
                    @error('role')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea name="description" id="description" rows="3"
                        class="form-control">{{old('description', $comisiondeliga->description)}}</textarea>
                    @error('description')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-12 text-center">
                    <div class="row text-center">
                        <div class="col-md-12 mb-2 mt-2">
                            <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                            <a href="{{route('comisiondeligas.index')}}">
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
</div>
@endsection

@push('js')

@endpush
