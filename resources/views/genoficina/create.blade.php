@extends('template')

@section('title', 'Crear OficinaGeneral')

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
    <li class="breadcrumb-item "><a href="{{route('genOficinas.index')}}">Oficina General</a> </li>
    <li class="breadcrumb-item active">Nueva Oficina General</li>
  </ol>
  <h1 class="my-4 text-center">Nueva Oficina General</h1>
  <div class="cuerpo">
    <form action="{{route('genOficinas.store')}}" method="post">
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
          <label for="short_name" class="form-label">Nombre Corto:</label>
          <input type="text" name="short_name" id="short_name" class="form-control" value="{{old('short_name')}}">
          @error('short_name')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="col-md-6">
          <label for="address" class="form-label">Dirección:</label>
          <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}">
          @error('address')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="col-md-6 mb-2">
          <label class="form-label" for="report_id">Reporte:</label>
          <select data-size="3" title="Seleccione un reporte" data-live-search="true" name="report_id" id="report_id" class="form-control selectpicker show-tick">
            @foreach ($reportes as $item)
            <option value="{{$item->id}}" {{old('report_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('report_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>


        <div class="col-md-6 mb-2">
          <label class="form-label" for="commission_league_id">Comisiones:</label>
          <select data-size="4" title="Seleccione una comision" data-live-search="true" name="commission_league_id" id="commission_league_id" class="form-control selectpicker show-tick">
            @foreach ($comisiones as $item)
            <option value="{{$item->id}}" {{old('commission_league_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('commission_league_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="col-md-6 mb-2">
          <label class="form-label" for="charge_id">Cargo:</label>
          <select data-size="4" title="Seleccione un Cargas" data-live-search="true" name="charge_id" id="charge_id" class="form-control selectpicker show-tick">
            @foreach ($cargas as $item)
            <option value="{{$item->id}}" {{old('charge_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('charge_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>


        <div class="col-md-6 mb-2">
          <label class="form-label" for="club_id">Club:</label>
          <select data-size="4" title="Seleccione un Club" data-live-search="true" name="club_id" id="club_id" class="form-control selectpicker show-tick">
            @foreach ($clubs as $item)
            <option value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('club_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>



        <div class="row text-center">
                            <div class="col-md-12 mb-2 mt-2">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('genOficinas.index')}}">
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
