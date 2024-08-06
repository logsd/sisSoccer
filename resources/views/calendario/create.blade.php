@extends('template')

@section('title', 'Nuevo Partido')

@push('css')
    <style>
        #observation {
            resize: none;
        }

        #description {
            resize: none;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

<style>
    .cuerpo {
        border: solid 3px black;
        border-radius: 10px;
        padding: 20px;
        background: #4EA93B;
        color: black;
        margin-bottom: 30px
    }

    .dt {
        border-left: solid 2px black;
        padding-left: 5%;
    }

    h4 {
        text-align: center;
        padding: 4px 5px;
    }

    .buttong {
        background-color: #32fc08;
        color: black;
        padding: 8px 30px 8px 30px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
    }

    .buttonr {
        background-color: #A5D29A;
        color: black;
        padding: 8px 30px 8px 30px;
        margin-left: 10px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
    }

    .buttonr:hover,
    .buttong:hover {
        background-color: #1A320F;
        color: white;
    }

    .fa-check,
    .fa-arrow-left {
        padding-right: 10px;
    }


</style>


@section('content')
<div class="container-fluid px-4 ">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('calendarios.index')}}"> Partidos</a> </li>
        <li class="breadcrumb-item active">Nuevo Partido</li>
    </ol>
    <h1 class="my-4 text-center">Nuevo Partido</h1>
    <div class=" ">
        <form action="{{route('calendarios.store')}}" method="post">
            @csrf
            <div class="cuerpo">
                <div class="row ">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div class="">
                            <div class="col-md-12 mb-2">
                                <h4>Detalles del Partido</h4>
                                <label for="stadium" class="form-label">Estadio:</label>
                                <input type="text" name="stadium" id="stadium" class="form-control"
                                    value="{{old('stadium')}}">
                                @error('stadium')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="observation" class="form-label">Observación:</label>
                                <textarea name="observation" id="observation" rows="3" class="form-control"></textarea>
                                @error('observation')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="referee" class="form-label">Arbitro:</label>
                                    <input type="text" name="referee" id="referee" class="form-control"
                                        value="{{old('referee')}}">
                                    @error('referee')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-2">
                                    <label for="vocal" class="form-label">Vocal:</label>
                                    <input type="text" name="vocal" id="vocal" class="form-control"
                                        value="{{old('vocal')}}">
                                    @error('vocal')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label" for="team_home_id">Equipo Local:</label>
                                    <select data-size="3" title="Seleccione un Equipo" data-live-search="true"
                                        name="team_home_id" id="team_home_id"
                                        class="form-control selectpicker show-tick">
                                        @foreach ($equipos as $item)
                                        <option value="{{$item->id}}" {{old('team_home_id')==$item->id ? 'selected' :
                                            ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('team_home_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label class="form-label" for="team_away_id">Equipo Visitante:</label>
                                    <select data-size="3" title="Seleccione un Equipo" data-live-search="true"
                                        name="team_away_id" id="team_away_id"
                                        class="form-control selectpicker show-tick">
                                        @foreach ($equipos as $item)
                                        <option value="{{$item->id}}" {{old('team_away_id')==$item->id ? 'selected' :
                                            ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('team_away_id')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                            </div>



                        </div>
                    </div>
                    <!---Fecha y hora-->
                    <div class="col-md-4">
                        <div class="dt">
                            <div class="row">
                                <h5 class="text-center">Datos Adicionales</h5>
                                <div class="col-md-12 mb-2">
                                    <label for="date" class="form-label ">Fecha:</label>
                                    <input type="date" name="date" id="date" class="form-control border-success"
                                        value="{{old('date')}}">
                                    @error('date')
                                        <small class="text-danger">{{'*' . $message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="time" class="form-label">Hora:</label>
                                    <input type="time" name="time" id="time" class="form-control border-success"
                                        value="{{ old('time') }}">
                                    @error('time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row">
                                    <h6 class="mt-3 mb-4"> <strong> Asignar Fase/Campeonato</strong></h6>

                                    <div class="col-md-12 mb-2">
                                        <label class="form-label" for="league_phase_id">Fase:</label>
                                        <select data-size="3" title="Seleccione una Fase" data-live-search="true"
                                            name="league_phase_id" id="league_phase_id"
                                            class="form-control selectpicker show-tick">
                                            @foreach ($fases as $item)
                                                <option value="{{$item->id}}" {{old('league_phase_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('league_phase_id')
                                            <small class="text-danger">{{'*' . $message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <label class="form-label" for="championship_id">Campeonato:</label>
                                        <select data-size="3" title="Seleccione un Campeonato" data-live-search="true"
                                            name="championship_id" id="championship_id"
                                            class="form-control selectpicker show-tick">
                                            @foreach ($campeonatos as $item)
                                                <option value="{{$item->id}}" {{old('championship_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('championship_id')
                                            <small class="text-danger">{{'*' . $message}}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>
                <div class="row text-end">
                    <div class="col-md-12 mb-2 mt-4">
                        <button type="submit" class="buttong"><i class="fa-solid fa-check"></i>Guardar</button>
                        <a href="{{route('calendarios.index')}}">
                            <button type="button" class="buttonr"><i
                                    class="fa-solid fa-arrow-left"></i>Regresar</button>
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
