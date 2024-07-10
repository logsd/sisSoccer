@extends('template')

@section('title', 'Crear ParametroGeneral')

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
  <h1 class="mt-4">Crear Parametro General</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
    <li class="breadcrumb-item "><a href="{{route('genParametros.index')}}">Parametro General</a> </li>
    <li class="breadcrumb-item active">Crear Parametro General</li>
  </ol>
  <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
    <form action="{{route('genParametros.store')}}" method="post">
      @csrf
      <div class="row g-3">

        <div class="col-md-6 mb-2">
          <label class="form-label" for="state_parameters_id">Estado Parametro</label>
          <select data-size="4" title="Seleccione un Estado" data-live-search="true" name="state_parameters_id" id="state_parameters_id" class="form-control selectpicker show-tick">
            @foreach ($estadoParametro as $item)
            <option value="{{$item->id}}" {{old('state_parameters_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('state_parameters_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="col-md-6 mb-2">
          <label class="form-label" for="civil_status_id">Estado Civil:</label>
          <select data-size="3" title="Seleccione un Estado Civil" data-live-search="true" name="civil_status_id" id="civil_status_id" class="form-control selectpicker show-tick">
            @foreach ($estadosCiviles as $item)
            <option value="{{$item->id}}" {{old('civil_status_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('civil_status_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>

        <div class="col-md-6 mb-2">
          <label class="form-label" for="phone_operator_id">Operadora Telefonica:</label>
          <select data-size="3" title="Seleccione una Operadora Telefonica" data-live-search="true" name="phone_operator_id" id="phone_operator_id" class="form-control selectpicker show-tick">
            @foreach ($operadoraTelefonica as $item)
            <option value="{{$item->id}}" {{old('phone_operator_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('phone_operator_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>


        <div class="col-md-6 mb-2">
          <label class="form-label" for="taxpayer_types_id">Tipo Contribuyente:</label>
          <select data-size="3" title="Seleccione el Tipo de Contribuyente" data-live-search="true" name="taxpayer_types_id" id="taxpayer_types_id" class="form-control selectpicker show-tick">
            @foreach ($tipoContribuyente as $item)
            <option value="{{$item->id}}" {{old('taxpayer_types_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('taxpayer_types_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>


        <div class="col-md-6 mb-2">
          <label class="form-label" for="type_parameters_id">Tipo Parametro:</label>
          <select data-size="3" title="Seleccione el Tipo de Parametro" data-live-search="true" name="type_parameters_id" id="type_parameters_id" class="form-control selectpicker show-tick">
            @foreach ($tipoParametro as $item)
            <option value="{{$item->id}}" {{old('type_parameters_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('type_parameters_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>


        <div class="col-md-6 mb-2">
          <label class="form-label" for="type_sanctions_id">Tipo Sancion:</label>
          <select data-size="3" title="Seleccione el Tipo de Sancion" data-live-search="true" name="type_sanctions_id" id="type_sanctions_id" class="form-control selectpicker show-tick">
            @foreach ($tipoSancion as $item)
            <option value="{{$item->id}}" {{old('type_sanctions_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
            @endforeach
          </select>
          @error('type_sanctions_id')
          <small class="text-danger">{{'*'.$message}}</small>
          @enderror
        </div>


        <div class="col-12 text-center">
          <button type="submit" class="btn btn-success ">Guardar</button>
        </div>
      </div>
    </form>
  </div>
  @endsection

  @push('js')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  @endpush