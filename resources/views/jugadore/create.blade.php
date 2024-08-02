@extends('template')

@section('title', 'Crear Partido')

@push('css')
<style>
    #observation {
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Jugadores</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('jugadores.index')}}"> Jugadores</a> </li>
        <li class="breadcrumb-item active">Crear Jugador</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('jugadores.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container mt-4">
                <div class="row gy-4">
                    <!--Crear Jugador--->
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Datos del Jugador
                        </div>
                        <div class="p-3 border border-3 border-primary">

                            <div class="col-md-12 mb-2">
                                <label for="dni" class="form-label">Cedula:</label>
                                <input type="number" name="dni" id="dni" class="form-control" value="{{old('dni')}}">
                                @error('dni')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="last_name" class="form-label">Apellido:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name')}}">
                                @error('last_name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="sexo">Género:</label>
                                <select title="Seleccione un Genero" name="sexo" id="sexo" class="form-control selectpicker show-tick">
                                    <option value="1" {{ old('sexo') == '1' ? 'selected' : '' }}>Hombre</option>
                                    <option value="0" {{ old('sexo') == '0' ? 'selected' : '' }}>Mujer</option>
                                </select>
                                @error('sexo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="birthday" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" value="{{old('birthday')}}">
                                @error('birthday')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <label for="observation" class="form-label">Observación:</label>
                                <textarea name="observation" id="observation" rows="3" class="form-control"></textarea>
                                @error('observation')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="f_from" class="form-label">Fecha Ingreso:</label>
                                <input type="date" name="f_from" id="f_from" class="form-control" value="{{old('f_from')}}">
                                @error('f_from')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="f_until" class="form-label">Fecha Salida:</label>
                                <input type="date" name="f_until" id="f_until" class="form-control" value="{{old('f_until')}}">
                                @error('f_until')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                        </div>
                    </div>
                    <!---Datos Adicionales-->
                    <div class="col-md-4">
                        <div class="text-white bg-success p-1 text-center">
                            Datos Adicionales
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">

                            <div class="col-md-12 mb-2">
                                <label for="direction" class="form-label">Dirección:</label>
                                <input type="text" name="direction" id="direction" class="form-control" value="{{old('direction')}}">
                                @error('direction')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="position" class="form-label">Posición:</label>
                                <input type="text" name="position" id="position" class="form-control" value="{{old('position')}}">
                                @error('position')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="img_url" class="form-label">Imagén:</label>
                                <input type="file" name="img_url" id="img_url" class="form-control" accept="Image/*">
                                @error('img_url')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label>
                                    <input type="checkbox" name="own" value="1" {{ old('own') ? 'checked' : '' }}> Own
                                </label>
                                <label>
                                    <input type="checkbox" name="booster" value="1" {{ old('booster') ? 'checked' : '' }}> Booster
                                </label>
                                <label>
                                    <input type="checkbox" name="youth" value="1" {{ old('youth') ? 'checked' : '' }}> Youth
                                </label>
                                <label>
                                    <input type="checkbox" name="certified" value="1" {{ old('certified') ? 'checked' : '' }}> Certified
                                </label>
                            </div>
                                <div class="text-white bg-primary p-1 text-center">
                                    Asignar Equipo/Liga 
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label class="form-label" for="province_id">Provincia:</label>
                                    <select data-size="3" title="Seleccione una Provincia" data-live-search="true" name="province_id" id="province_id" class="form-control selectpicker show-tick">
                                        @foreach ($provincias as $item)
                                        <option value="{{$item->id}}" {{old('province_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label class="form-label" for="team_id">Equipo:</label>
                                    <select data-size="3" title="Seleccione un Equipo" data-live-search="true" name="team_id" id="team_id" class="form-control selectpicker show-tick">
                                        @foreach ($equipos as $item)
                                        <option value="{{$item->id}}" {{old('team_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('team_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label class="form-label" for="league_id">Liga:</label>
                                    <select data-size="3" title="Seleccione una Liga" data-live-search="true" name="league_id" id="league_id" class="form-control selectpicker show-tick">
                                        @foreach ($ligas as $item)
                                        <option value="{{$item->id}}" {{old('league_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('league_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
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
    @endpush