@extends('template')

@section('title', 'Crear Cargo')

@push('css')
<style>
    #observation{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Crear Cargos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('cargos.index')}}">Cargos</a> </li>
                            <li class="breadcrumb-item active">Crear Cargos</li>
                        </ol>
<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('cargos.store')}}" method="post">
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
                <label for="f_start" class="form-label">Fecha Entrada:</label>
                <input type="date" name="f_start" id="f_start" class="form-control" value="{{old('f_start')}}">
                @error('f_start')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
                <label for="f_end" class="form-label">Fecha Salida:</label>
                <input type="date" name="f_end" id="f_end" class="form-control" value="{{old('f_end')}}">
                @error('f_end')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-12">
                <label for="observation" class="form-label">Observación:</label>
                <textarea name="observation" id="observation" rows="3" class="form-control"></textarea>
                @error('observation')
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