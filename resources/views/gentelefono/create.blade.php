@extends('template')

@section('title', 'Crear TelefonoGeneral')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Crear Telefono General</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('genTelefonos.index')}}">Telefono</a> </li>
                            <li class="breadcrumb-item active">Crear Telefono</li>
                        </ol>
<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('genTelefonos.store')}}" method="post">
    @csrf
    <div class="row g-3">

        <div class="col-md-6">
                <label for="number" class="form-label">Numero:</label>
                <input type="number" name="number" id="number" class="form-control" value="{{old('number')}}">
                @error('number')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        
        <div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{old('description')}}">
                @error('description')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6 mb-2">
                        <label class="form-label" for="league_executive_id">Ejecutivo</label>
                      <select data-size="4" title="Seleccione un ejecutivo" data-live-search="true" name="league_executive_id" id="league_executive_id" class="form-control selectpicker show-tick">
                        @foreach ($ejecutivos as $item)
                            <option value="{{$item->id}}" {{old('league_executive_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                      </select>
                        @error('league_executive_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
        </div>

        <div class="col-md-6 mb-2">
                        <label class="form-label" for="employee_id">Empleado</label>
                      <select data-size="4" title="Seleccione un Empleado" data-live-search="true" name="employee_id" id="employee_id" class="form-control selectpicker show-tick">
                        @foreach ($empleados as $item)
                            <option value="{{$item->id}}" {{old('employee_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                      </select>
                        @error('employee_id')
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

@endpush