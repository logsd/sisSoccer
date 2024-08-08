@extends('template')

@section('title', 'Actualizar Periodo')

@push('css')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('periodos.index')}}">Periodos</a> </li>
        <li class="breadcrumb-item active">Actualizar Periodo</li>
    </ol>
    <h1 class="my-4 text-center">Actualizar Periodo</h1>

        <form action="{{route('periodos.update',['periodo'=>$periodo])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="row gy-4">
                    <!--Crear Equipo--->
                    <div class="cuerpo">
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div>
                            <div class="col-md-12 mb-2">
                                <h4>Detalles Periodo</h4>
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$periodo->name)}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="start" class="form-label">Fecha Inicio:</label>
                                <input type="date" name="start" id="start" class="form-control" value="{{old('start',$periodo->start)}}">
                                @error('start')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="end" class="form-label">Fecha Fin:</label>
                                <input type="date" name="end" id="end" class="form-control" value="{{old('end',$periodo->end)}}">
                                @error('end')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Descripción:</label>
                                <textarea name="description" id="description" rows="3" class="form-control"> {{old('observation',$periodo->description)}}</textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!---Equipo-->
                    <div class="col-md-4">

<div class="dt mb-5">
    <div class="row">
        <h4>Equipo</h4>
                                    <label class="form-label" for="club_id">Equipo:</label>
                                    <select data-size="3" title="Seleccione un Club" data-live-search="true" name="team_id" id="team_id" class="form-control selectpicker show-tick">
                                    @foreach ($equipos as $item)
                                        @if ($periodo->team_id == $item->id)
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

                            </div>
                        </div>
                        <div class="row text-center mt-4">
                            <div class="col-md-12 mb-2 ">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('periodos.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Cancelar</button>
                                </a>

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

    @endpush
