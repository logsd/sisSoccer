@extends('template')

@section('title', 'Editar Campeonato')

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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Campeonatos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('campeonatos.index')}}">Campeonatos</a> </li>
        <li class="breadcrumb-item active">Editar Campeonato</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('campeonatos.update',['campeonato'=>$campeonato])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="container mt-4">
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles Campeonato
                        </div>
                        <div class="p-3 border border-3 border-primary">

                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$campeonato->name)}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="year" class="form-label">Año:</label>
                                <input type="text" name="year" id="year" class="form-control" value="{{old('year',$campeonato->year)}}">
                                @error('year')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label" for="category_id">Categoria:</label>
                                <select data-size="4" title="Seleccione una Categoria" data-live-search="true" name="category_id" id="category_id" class="form-control selectpicker show-tick">
                                    @foreach ($categorias as $item)
                                    @if ($campeonato->category_id == $item->id)
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


                            <div class="col-md-12">
                                <label for="observation" class="form-label">Observación:</label>
                                <textarea name="observation" id="observation" rows="2" class="form-control"> {{old('observation',$campeonato->observation)}}</textarea>
                                @error('observation')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <label for="description" class="form-label">Descripción:</label>
                                <textarea name="description" id="description" rows="3" class="form-control"> {{old('observation',$campeonato->description)}}</textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!---Fechas-->
                    <div class="col-md-4">
                        <div class="text-white bg-success p-1 text-center">
                            Fechas
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">

                                <div class="col-md-12 mb-2">
                                    <label for="start_date" class="form-label ">Fecha Inicio:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control border-success" value="{{old('start_date',$campeonato->start_date)}}">
                                    @error('start_date')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="end_date" class="form-label ">Fecha Fin:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control border-success" value="{{old('end_date',$campeonato->end_date)}}">
                                    @error('end_date')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>


                                <div class="col-md-12 mb-2">
                                    <label for="from" class="form-label ">Fecha Desde:</label>
                                    <input type="date" name="from" id="from" class="form-control border-success" value="{{old('from',$campeonato->from)}}">
                                    @error('from')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="until" class="form-label ">Fecha Hasta:</label>
                                    <input type="date" name="until" id="until" class="form-control border-success" value="{{old('until',$campeonato->until)}}">
                                    @error('until')
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