@extends('template')

@section('title', 'Actualizar Jugador')

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

<style>
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
        <li class="breadcrumb-item "><a href="{{route('jugadores.index')}}"> Jugadores</a> </li>
        <li class="breadcrumb-item active">Actualizar Jugador</li>
    </ol>
    <h1 class="my-4 text-center">Actualizar Jugador</h1>
    <div class="cuerpo">
        <form action="{{route('jugadores.update',['jugadore'=>$jugadore])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-7">
                        <div>

                            <div class="col-md-12 mb-2">
                                <h4>Detalles Campeonato</h4>

                                <label for="dni" class="form-label">Cédula:</label>
                                <input type="number" name="dni" id="dni" class="form-control" value="{{old('dni',$jugadore->dni)}}">
                                @error('dni')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$jugadore->name)}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="last_name" class="form-label">Apellido:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name',$jugadore->last_name)}}">
                                @error('last_name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="sexo">Género:</label>
                                <select title="Seleccione un Genero" name="sexo" id="sexo" class="form-control selectpicker show-tick">
                                    <option value="1" {{ old('sexo', $jugadore->sexo) == '1' ? 'selected' : '' }}>Hombre</option>
                                    <option value="0" {{ old('sexo', $jugadore->sexo) == '0' ? 'selected' : '' }}>Mujer</option>
                                </select>
                                @error('sexo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="birthday" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" value="{{old('birthday',$jugadore->birthday)}}">
                                @error('birthday')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="observation" class="form-label">Observación:</label>
                                <textarea name="observation" id="observation" rows="3" class="form-control">{{old('observation',$jugadore->observation)}}</textarea>
                                @error('observation')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="f_from" class="form-label">Fecha Ingreso:</label>
                                <input type="date" name="f_from" id="f_from" class="form-control" value="{{old('f_from',$jugadore->f_from)}}">
                                @error('f_from')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="f_until" class="form-label">Fecha Salida:</label>
                                <input type="date" name="f_until" id="f_until" class="form-control" value="{{old('f_until',$jugadore->f_until)}}">
                                @error('f_until')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                        </div>
                    </div>
                    <!---Datos Adicionales-->
                    <div class="col-md-5">

                        <div class="dt mb-5">
                            <div class="row">
                                <h4>Datos Adicionales</h4>

                                <div class="col-md-12 mb-2">
                                    <label for="direction" class="form-label">Dirección:</label>
                                    <input type="text" name="direction" id="direction" class="form-control" value="{{old('direction',$jugadore->direction)}}">
                                    @error('direction')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="position" class="form-label">Posición:</label>
                                    <input type="text" name="position" id="position" class="form-control" value="{{old('position',$jugadore->position)}}">
                                    @error('position')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="img_url" class="form-label">Imagen:</label>
                                    <input type="file" name="img_url" id="img_url" class="form-control" accept="Image/*">
                                    @error('img_url')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>
                                        <input type="checkbox" name="own" value="1" {{ old('own', $jugadore->own) ? 'checked' : '' }}> Own
                                    </label>
                                    <label>
                                        <input type="checkbox" name="booster" value="1" {{ old('booster', $jugadore->booster) ? 'checked' : '' }}> Booster
                                    </label>
                                    <label>
                                        <input type="checkbox" name="youth" value="1" {{ old('youth', $jugadore->youth) ? 'checked' : '' }}> Youth
                                    </label>
                                    <label>
                                        <input type="checkbox" name="certified" value="1" {{ old('certified', $jugadore->certified) ? 'checked' : '' }}> Certified
                                    </label>
                                </div>

                                <h4 class="text-start mt-4">Asignar Equipo/Liga</h4>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label" for="province_id">Provincia:</label>
                                    <select data-size="3" title="Seleccione una Provincia" data-live-search="true" name="province_id" id="province_id" class="form-control selectpicker show-tick">
                                        @foreach ($provincias as $item)
                                        @if ($jugadore->province_id == $item->id)
                                        <option selected value="{{$item->id}}" {{old('province_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                                        @else
                                        <option value="{{$item->id}}" {{old('province_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endif
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
                                        @if ($jugadore->team_id == $item->id)
                                        <option selected value="{{$item->id}}" {{old('team_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @else
                                        <option value="{{$item->id}}" {{old('team_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endif
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
                                        @if ($jugadore->league_id == $item->id)
                                        <option selected value="{{$item->id}}" {{old('league_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @else
                                        <option value="{{$item->id}}" {{old('league_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endif
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
                                        @if ($jugadore->category_id == $item->id)
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

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center ">
                            <div class="col-md-12 mb-2">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('jugadores.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Cancelar</button>
                                </a>

                            </div>
                        </div>
            </div>
        </form>
    </div>
    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    @endpush
