@extends('template')

@section('title', 'Crear Campeonato')

@push('css')
<style>
    #description {
        resize: none;
    }
    #descriptionGrupo {
        resize: none;
    }

    .d-none {
        display: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Fase Campeonatos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('fases.index')}}"> Fase Campeonatos</a> </li>
        <li class="breadcrumb-item active">Crear Fase Campeonatos</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('fases.store')}}" method="post">
            @csrf
            <div class="container mt-4">
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles Fase Campeonato
                        </div>
                        <div class="p-3 border border-3 border-primary">

                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Descripción:</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2 grupo d-none">
                                <label for="nameGrupo" class="form-label">Nombre Grupo:</label>
                                <input type="text" name="nameGrupo" id="nameGrupo" class="form-control" value="{{old('nameGrupo')}}">
                                @error('nameGrupo')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 grupo d-none">
                                <label for="descriptionGrupo" class="form-label">Descripción Grupo:</label>
                                <textarea name="descriptionGrupo" id="descriptionGrupo" rows="3" class="form-control"></textarea>
                                @error('descriptionGrupo')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!---Campeonato-->
                    <div class="col-md-4">
                        <div class="text-white bg-success p-1 text-center">
                            Campeonatos
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">


                                <div class="col-md-12 mb-2">
                                    <label class="form-label" for="championship_id">Campeonato:</label>
                                    <select data-size="3" title="Seleccione un Campeonato" data-live-search="true" name="championship_id" id="championship_id" class="form-control selectpicker show-tick">
                                        <option value=""></option>
                                        @foreach ($campeonatos as $item)
                                        <option value="{{$item->id}}" {{old('championship_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('championship_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2 mt-4 text-center">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const championshipSelect = document.getElementById('championship_id');
            const grupoFields = document.querySelectorAll('.grupo');

            function toggleGrupoFields() {
                if (championshipSelect.value) {
                    grupoFields.forEach(field => field.classList.remove('d-none'));
                } else {
                    grupoFields.forEach(field => field.classList.add('d-none'));
                }
            }

            // Mostrar campos si ya hay un campeonato seleccionado al cargar la página
            toggleGrupoFields();

            // Añadir evento para cambiar la visibilidad de los campos cuando cambia el select
            championshipSelect.addEventListener('change', toggleGrupoFields);
        });
    </script>
    @endpush