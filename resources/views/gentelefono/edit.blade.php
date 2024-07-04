@extends('template')

@section('title', 'Editar TelefonoGeneral')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Telefono</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('genTelefonos.index')}}">Telefono</a> </li>
                            <li class="breadcrumb-item active">Editar Telefono</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('genTelefonos.update',['genTelefono'=>$genTelefono])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="number" class="form-label">Numero:</label>
                <input type="number" name="number" id="number" class="form-control" value="{{old('number',$genTelefono->number)}}">
                @error('number')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
                <label for="description" class="form-label">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{old('description',$genTelefono->description)}}">
                @error('description')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6 mb-2">
                    <label class="form-label" for="league_executive_id">Ejecutivo</label>
                    <select data-size="4" title="Seleccione un Ejecutivo" data-live-search="true" name="league_executive_id" id="league_executive_id" class="form-control selectpicker show-tick">
                        @foreach ($ejecutivos as $item)
                        @if ($genTelefono->league_executive_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('league_executive_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('league_executive_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
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
                        @if ($genTelefono->employee_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('employee_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('employee_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('employee_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
        </div>
        
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-success ">Actualizar</button>
            <button type="reset" class="btn btn-secondary">Reiniciar</button>
        </div>
    </div>
</form>
</div>
</div>
@endsection

@push('js')

@endpush