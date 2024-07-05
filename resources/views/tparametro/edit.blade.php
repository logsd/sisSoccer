@extends('template')

@section('title', 'Editar Comisionde de Ligas')

@push('css')
<style>
    #observation{
        resize: none;
    }
    .img-container {
            width: 300px; /* Establece el ancho del contenedor */
            height: 200px; /* Establece la altura del contenedor */
            overflow: hidden; /* Esconde cualquier contenido que se desborde */
            position: relative;
        }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Tipos de Parametros</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('tparametros.index')}}">Tipos de Parametros</a> </li>
                            <li class="breadcrumb-item active">Editar Tipo de Parametro</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('tparametros.update',['tparametro'=>$tparametro])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$tparametro->name)}}">
                @error('name')
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
