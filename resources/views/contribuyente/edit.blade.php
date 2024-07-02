@extends('template')

@section('title', 'Editar Contribuyente')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Contribuyentes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('contribuyentes.index')}}">Contribuyentes</a> </li>
                            <li class="breadcrumb-item active">Editar Contribuyente</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('contribuyentes.update',['contribuyente'=>$contribuyente])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

<div class="col-md-6">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{old('name',$contribuyente->name)}}">
        @error('name')
        <small class="text-danger">{{'*'.$message}}</small>
        @enderror
</div>

<div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$contribuyente->description)}}</textarea>
                @error('description')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


<div class="col-md-6">
        <div class="form-check form-switch">
        <input type="hidden" name="a_cont" value="0">
            <label class="form-check-label" for="a_cont">A Cont</label>
             <input  name="a_cont" class="form-check-input" type="checkbox" role="switch" id="a_cont" value="1" {{ old('a_cont', $contribuyente->a_cont) ? 'checked' : '' }}>
                @error('a_cont')
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