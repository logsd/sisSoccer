@extends('template')

@section('title', 'Actualizar Equipo')

@push('css')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')

<style>
        #description {
        resize: none;
    }

    .d-none {
        display: none;
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

    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('equipos.index')}}">Equipos</a> </li>
        <li class="breadcrumb-item active">Actualizar Equipo</li>
    </ol>
    <h1 class="my-4 text-center">Actualizar Equipo</h1>

        <form action="{{route('equipos.update',['equipo'=>$equipo])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="cuerpo">
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div>

                            <div class="col-md-12 mb-2">
                                <h4>Detalles del Equipo</h4>
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

                            <div class="col-md-12 mb-2"></div>
                                <label for="gender" class="mb-2">Género:</label>
                                <select title="Seleccione un Genero" name="gender" id="gender" class="form-control selectpicker show-tick mb-2">
                                    <option value="1" {{ old('gender', $equipo->gender) == '1' ? 'selected' : '' }}>Masculino</option>
                                    <option value="0" {{ old('gender', $equipo->gender) == '0' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </>

                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label mb-2">Descripción:</label>
                                <textarea name="description" id="description" rows="3" class="form-control"> {{old('observation',$equipo->description)}}</textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!---atributos-->
                    <div class="col-md-4">

<div class="dt mb-5">
    <div class="row">
        <h4>Atributos</h4>
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

                                <label class="form-label fw-bold border-t-2 border-black" for="goles">Goles:</label>
                                <div class="col-md-4     goles-puntos d-none">
                                    <label for="gol_afa" class="form-label">A favor:</label>
                                    <input type="text" name="gol_afa" id="gol_afa" class="form-control" value="{{ old('gol_afa', $equipo->gol_afa) }}">
                                    @error('gol_afa')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 goles-puntos d-none">
                                    <label for="gol_enc" class="form-label">En contra:</label>
                                    <input type="text" name="gol_enc" id="gol_enc" class="form-control" value="{{ old('gol_enc', $equipo->gol_enc) }}">
                                    @error('gol_enc')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4 goles-puntos d-none">
                                    <label for="points" class="form-label ">Puntos:</label>
                                    <input type="number" name="points" id="points" class="form-control" value="{{ old('points', $equipo->points) }}">
                                    @error('points')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row text-end">
                            <div class="col-md-12 mb-2 ">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('equipos.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Cancelar</button>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

            </>
        </form>
    </>
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
