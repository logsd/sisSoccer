@extends('template')

@section('title', 'Editar Categoria')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Categorias</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('categorias.index')}}">Categorias</a> </li>
                            <li class="breadcrumb-item active">Editar Categoria</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('categorias.update',['categoria'=>$categoria])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$categoria->name)}}">
                @error('name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        
        <div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$categoria->description)}}</textarea>
                @error('description')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
        <div class="form-check form-switch">
        <input type="hidden" name="validity" value="0">
            <label class="form-check-label" for="vg">Validez</label>
             <input  name="validity" class="form-check-input" type="checkbox" role="switch" id="validity" value="1" {{ old('validity', $categoria->validity) ? 'checked' : '' }}>
                @error('validity')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>
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