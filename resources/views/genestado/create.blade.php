@extends('template')

@section('title', 'Crear EstadoGeneral')

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
  <h1 class="mt-4">Crear Estado General</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
    <li class="breadcrumb-item "><a href="{{route('genEstados.index')}}">Estado General</a> </li>
    <li class="breadcrumb-item active">Crear Estado General</li>
  </ol>
  <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
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