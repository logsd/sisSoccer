@extends('template')

@section('title', 'Editar Equipo')

@push('css')
<style>
    #description {
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
    <h1 class="mt-4">Editar Equipos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('equipos.index')}}">Equipos</a> </li>
        <li class="breadcrumb-item active">Editar Equipo</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('equipos.update',['equipo'=>$equipo])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="container mt-4">
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles Equipo
                        </div>
                        <div class="p-3 border border-3 border-primary">

                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$equipo->name)}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="cluster" class="form-label">Grupo:</label>
                                <input type="text" name="cluster" id="cluster" class="form-control" value="{{old('cluster',$equipo->cluster)}}">
                                @error('cluster')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Género:</label>
                                <select title="Seleccione un Genero" name="gender" id="gender" class="form-control selectpicker show-tick">
                                    <option value="1" {{ old('gender', $equipo->gender) == '1' ? 'selected' : '' }}>Varonil</option>
                                    <option value="0" {{ old('gender', $equipo->gender) == '0' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Descripción:</label>
                                <textarea name="description" id="description" rows="3" class="form-control"> {{old('observation',$equipo->description)}}</textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!---atributos-->
                    <div class="col-md-4">
                        <div class="text-white bg-success p-1 text-center">
                            Atributos
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">

                                <div class="col-md-12 mb-2">
                                    <label class="form-label" for="category_id">Categoria:</label>
                                    <select data-size="3" title="Seleccione una Categoria" data-live-search="true" name="category_id" id="category_id" class="form-control selectpicker show-tick">
                                        @foreach ($categorias as $item)
                                        @if ($equipo->category_id == $item->id)
                                        <option selected value="{{$item->id}}" {{old('category_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                                        @else
                                        <option value="{{$item->id}}" {{old('category_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endif
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
                                        @if ($equipo->club_id == $item->id)
                                        <option selected value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                                        @else
                                        <option value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('club_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label class="form-label" for="championship_id">Asignar Campeonato:</label>
                                    <select data-size="3" title="Seleccione un Campeonato" data-live-search="true" name="championship_id" id="championship_id" class="form-control selectpicker show-tick">
                                        <option value=""></option>
                                        @foreach ($campeonatos as $item)
                                        <option value="{{ $item->id }}" {{ old('championship_id', $equipo->championship_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('championship_id')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <input disabled type="text" class="form-control fw-bold" value="Goles:">
                                </div>

                                <div class="col-md-4 mb-2 goles-puntos d-none">
                                    <label for="gol_afa" class="form-label">A favor:</label>
                                    <input type="text" name="gol_afa" id="gol_afa" class="form-control" value="{{ old('gol_afa', $equipo->gol_afa) }}">
                                    @error('gol_afa')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-2 goles-puntos d-none">
                                    <label for="gol_enc" class="form-label">En contra:</label>
                                    <input type="text" name="gol_enc" id="gol_enc" class="form-control" value="{{ old('gol_enc', $equipo->gol_enc) }}">
                                    @error('gol_enc')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-2 goles-puntos d-none">
                                    <label for="points" class="form-label fw-bold">Puntos:</label>
                                    <input type="number" name="points" id="points" class="form-control" value="{{ old('points', $equipo->points) }}">
                                    @error('points')
                                    <small class="text-danger">{{ '*' . $message }}</small>
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
            const golesPuntosFields = document.querySelectorAll('.goles-puntos');

            function toggleGolesPuntosFields() {
                if (championshipSelect.value) {
                    golesPuntosFields.forEach(field => field.classList.remove('d-none'));
                } else {
                    golesPuntosFields.forEach(field => field.classList.add('d-none'));
                }
            }

            // Mostrar campos si ya hay un campeonato seleccionado al cargar la página
            toggleGolesPuntosFields();

            // Añadir evento para cambiar la visibilidad de los campos cuando cambia el select
            championshipSelect.addEventListener('change', toggleGolesPuntosFields);
        });
    </script>
    @endpush