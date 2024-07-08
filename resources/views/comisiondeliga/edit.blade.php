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
                        <h1 class="mt-4">Editar Comisionde de Ligas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('comisiondeligas.index')}}">Comision de Liga</a> </li>
                            <li class="breadcrumb-item active">Editar Comision de Liga</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('comisiondeligas.update',['comisiondeliga'=>$comisiondeliga])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$comisiondeliga->name)}}">
                @error('name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>
        <div class="col-md-6">
                <label for="short_name" class="form-label">Nombre Corto:</label>
                <input type="text" name="short_name" id="short_name" class="form-control" value="{{old('short_name',$comisiondeliga->short_name)}}">
                @error('short_name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-6">
                <label for="role" class="form-label">Rol:</label>
                <input type="text" name="role" id="role" class="form-control" value="{{old('role',$comisiondeliga->role)}}">
                @error('role')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$comisiondeliga->description)}}</textarea>
                @error('description')
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
