@extends('template')

@section('title', 'Crear EstadoGeneral')

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
    <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
    <li class="breadcrumb-item "><a href="{{route('genEstados.index')}}">Estado General</a> </li>
    <li class="breadcrumb-item active">Nuevo Estado General</li>
  </ol>
  <h1 class="my-4 text-center">Nuevo Estado General</h1>
  <div class="cuerpo">
    <form action="{{route('genEstados.store')}}" method="post">
      @csrf
      <div class="row g-3">

        <div class="col-md-6">
          <label for="name" class="form-label">Nombre:</label>
          <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
          @error('name')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="col-md-6">
          <label for="description" class="form-label">Descripción:</label>
          <input type="text" name="description" id="description" class="form-control" value="{{old('description')}}">
          @error('description')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="col-md-6 mb-2">
          <label class="form-label" for="league_executive_id">Ejecutivo:</label>
          <select data-size="3" title="Seleccione un Ejecutivo" data-live-search="true" name="league_executive_id" id="league_executive_id" class="form-control selectpicker show-tick">
            @foreach ($ejecutivos as $item)
            <option value="{{$item->id}}" {{old('league_executive_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('league_executive_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="row text-center">
                            <div class="col-md-12 mb-2 mt-2">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('genEstados.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
                                <div class="col-md-12 mb-2">
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
