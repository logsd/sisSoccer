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
                        <h1 class="mt-4">Crear Tipo de Parámetros </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('tparametros.index')}}">Tipo de Parámetros</a> </li>
                            <li class="breadcrumb-item active">Crear Tipo de Parámetros</li>
                        </ol>
<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('tparametros.store')}}" method="post">
    @csrf
    <div class="row g-3">

        <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                @error('name')
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
