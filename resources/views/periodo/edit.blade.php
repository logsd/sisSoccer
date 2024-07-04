@extends('template')

@section('title', 'Editar Periodo')

@push('css')
<style>
    #description {
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Periodos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('periodos.index')}}">Periodos</a> </li>
        <li class="breadcrumb-item active">Editar Periodo</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('periodos.update',['periodo'=>$periodo])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="container mt-4">
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles Periodo
                        </div>
                        <div class="p-3 border border-3 border-primary">

                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$periodo->name)}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="start" class="form-label">Fecha Inicio:</label>
                                <input type="date" name="start" id="start" class="form-control" value="{{old('start',$periodo->start)}}">
                                @error('start')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="end" class="form-label">Fecha Fin:</label>
                                <input type="date" name="end" id="end" class="form-control" value="{{old('end',$periodo->end)}}">
                                @error('end')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
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
                        <div class="text-white bg-success p-1 text-center">
                            Equipo
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">

                                <div class="col-md-12 mb-2">
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