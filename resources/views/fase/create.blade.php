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

<style>
    #observation {
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

    .dt {
        border-left: solid 2px black;
        padding-left: 6%;

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
        background-color: #A5D29A;
        color: black;
        padding: 8px 20px 8px 20px;
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

<div class="container-fluid my-4">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('fases.index')}}"> Fase Campeonatos</a> </li>
        <li class="breadcrumb-item active">Nueva Fase Campeonato</li>
    </ol>
    <h1 class="my-4 text-center">Nueva Fase Campeonato</h1>
    <div class="cuerpo">
        <form action="{{route('fases.store')}}" method="post">
            @csrf

                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-12">
                        <div>
                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Descripción:</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

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



                        </div>
                        <div class="row text-center">
                            <div class="col-md-12 mb-2 mt-2">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('fases.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
                                <div class="col-md-12 mb-2">
                                </div>
                            </div>
                        </div>
                    </div>
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
