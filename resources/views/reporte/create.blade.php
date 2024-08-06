@extends('template')

@section('title', 'Crear Reporte')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Crear Reportes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('reportes.index')}}">Reportes</a> </li>
                            <li class="breadcrumb-item active">Crear Reportes</li>
                        </ol>
<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('reportes.store')}}" method="post">
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
                <label for="role" class="form-label">Rol:</label>
                <input type="text" name="role" id="role" class="form-control" value="{{old('role')}}">
                @error('role')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        
        <div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                @error('description')
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