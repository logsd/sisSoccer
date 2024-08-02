@extends('template')

@section('title', 'Actualizar Campeonato')

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
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('campeonatos.index')}}">Campeonatos</a> </li>
        <li class="breadcrumb-item active">Actualizar Campeonato</li>
    </ol>
    <h1 class="my-4 text-center">Actualizar Campeonato</h1>
    <div class="container ">
        <form action="{{route('campeonatos.update', ['campeonato' => $campeonato])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="cuerpo">
                <div class="row gy-4">
                    <!--Crear Campeonato--->
                    <div class="col-md-8">
                        <div>

                            <div class="col-md-12 mb-2">
                                <h4>Detalles Campeonato</h4>
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{old('name',$campeonato->name)}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="year" class="form-label">Año:</label>
                                <input type="text" name="year" id="year" class="form-control"
                                    value="{{old('year',$campeonato->year)}}">
                                @error('year')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label" for="category_id">Categoria:</label>
                                <select data-size="4" title="Seleccione una Categoria" data-live-search="true"
                                    name="category_id" id="category_id" class="form-control selectpicker show-tick">
                                    @foreach ($categorias as $item)
                                    @if ($campeonato->category_id == $item->id)
                                    <option selected value="{{$item->id}}" {{old('category_id')==$item->id ? 'selected'
                                        : ''}}>{{$item->name}}</option>

                                    @else
                                    <option value="{{$item->id}}" {{old('category_id')==$item->id ? 'selected' :
                                        ''}}>{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="observation" class="form-label">Observación:</label>
                                <textarea name="observation" id="observation" rows="2"
                                    class="form-control"> {{old('observation',$campeonato->observation)}}</textarea>
                                @error('observation')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">Descripción:</label>
                                <textarea name="description" id="description" rows="3"
                                    class="form-control"> {{old('observation',$campeonato->description)}}</textarea>
                                @error('description')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <!---Fechas-->
                    <div class="col-md-4">

                        <div class="dt mb-5">
                            <div class="row">
                                <h4>Fechas</h4>
                                <label for="start_date" class="form-label ">Fecha Inicio:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control border-success"
                                    value="{{old('start_date', $campeonato->start_date)}}">
                                @error('start_date')
                                    <small class="text-danger">{{'*' . $message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="end_date" class="form-label ">Fecha Fin:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control border-success"
                                    value="{{old('end_date', $campeonato->end_date)}}">
                                @error('end_date')
                                    <small class="text-danger">{{'*' . $message}}</small>
                                @enderror
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="from" class="form-label ">Fecha Desde:</label>
                                <input type="date" name="from" id="from" class="form-control border-success"
                                    value="{{old('from', $campeonato->from)}}">
                                @error('from')
                                    <small class="text-danger">{{'*' . $message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="until" class="form-label ">Fecha Hasta:</label>
                                <input type="date" name="until" id="until" class="form-control border-success"
                                    value="{{old('until', $campeonato->until)}}">
                                @error('until')
                                    <small class="text-danger">{{'*' . $message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row text-end">
                            <div class="col-md-12 mb-2 mt-5">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('campeonatos.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Cancelar</button>
                                </a>
                                <div class="col-md-12 mb-2">
                                </div>
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

@endpush
