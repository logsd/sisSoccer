@extends('template')

@section('title', 'Crear Equipo')

@push('css')
<style>
    #description {
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

<style>
    .cuerpo{
        border: solid 3px black;
        border-radius: 10px;
        padding: 20px;
        background:#4EA93B;
        color: black;
    }

    h4{
        text-align: center;
        padding: 4px 5px;
    }

    .button{
        background-color: #1A320F;
        color: white;
        padding: 8px 25px 8px 25px;
        margin: 15px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 20px;
    }

    .button:hover{
        background-color:#337326;
        color:white;
    }

</style>

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center mb-4">Crear Equipos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('equipos.index')}}">Equipos</a> </li>
        <li class="breadcrumb-item active">Crear Equipos</li>
    </ol>
        <form action="{{route('equipos.store')}}" method="post">
            @csrf
            <div class="container ">
                <div class="row gy-4 ">
                    <!--Crear Equipo--->
                    <div class="col-md-8 ">

                        <div class="cuerpo">
                            <div class="col-md-12 mb-2">
                                <h4>Detalle de Equipo</h4>
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="cluster" class="form-label">Grupo:</label>
                                <input type="text" name="cluster" id="cluster" class="form-control" value="{{old('cluster')}}">
                                @error('cluster')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="gender">Género:</label>
                                <select title="Seleccione un Genero" name="gender" id="gender" class="form-control selectpicker show-tick">
                                    <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Varonil</option>
                                    <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <label for="description" class="form-label">Descripción:</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!---Fechas-->
                    <div class="col-md-4">
                        <div class="cuerpo">
                            <div class="row">

                            <div class="col-md-12 mb-2">
                                <h4>Atributos</h4>
                                <label class="form-label" for="category_id">Categoria:</label>
                                <select data-size="3" title="Seleccione una Categoria" data-live-search="true" name="category_id" id="category_id" class="form-control selectpicker show-tick">
                                    @foreach ($categorias as $item)
                                    <option value="{{$item->id}}" {{old('category_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label class="form-label" for="club_id">Club:</label>
                                <select data-size="3" title="Seleccione un Club" data-live-search="true" name="club_id" id="club_id" class="form-control selectpicker show-tick">
                                    @foreach ($clubs as $item)
                                    <option value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('club_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>
                            </div>
                        </div>
                        <div class="mb-2 mt-4">
                        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{route('equipos.index')}}">
            <button type="button" class="button">Regresar</button>
        </a>
                </div>
        </form>
    </div>
                    </div>

                </div>

    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    @endpush
