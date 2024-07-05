@extends('template')

@section('title', 'Editar Cargo')

@push('css')
<style>
    #observation{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Cargos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('cargos.index')}}">Cargos</a> </li>
                            <li class="breadcrumb-item active">Editar Cargo</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('cargos.update',['cargo'=>$cargo])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

<div class="col-md-6">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{old('name',$cargo->name)}}">
        @error('name')
        <small class="text-danger">{{'*'.$message}}</small>
        @enderror
</div>

<div class="col-md-6">
        <label for="f_start" class="form-label">Fecha Entrada:</label>
        <input type="date" name="f_start" id="f_start" class="form-control" value="{{old('f_start',$cargo->f_start)}}">
        @error('f_start')
        <small class="text-danger">{{'*'.$message}}</small>
        @enderror
</div>

<div class="col-md-6">
        <label for="f_end" class="form-label">Fecha Salida:</label>
        <input type="date" name="f_end" id="f_end" class="form-control" value="{{old('f_end',$cargo->f_end)}}">
        @error('f_end')
        <small class="text-danger">{{'*'.$message}}</small>
        @enderror
</div>


<div class="col-md-12">
        <label for="observation" class="form-label">Observación:</label>
        <textarea name="observation" id="observation" rows="3" class="form-control">{{old('observation',$cargo->observation)}}</textarea>
        @error('observation')
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