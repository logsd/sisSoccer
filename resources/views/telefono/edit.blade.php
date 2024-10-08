@extends('template')

@section('title', 'Editar Operadora')

@push('css')
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Operadoras</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('telefonos.index')}}">Operadoras</a> </li>
                            <li class="breadcrumb-item active">Editar Operadora</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('telefonos.update',['telefono'=>$telefono])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

<div class="col-md-6">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{old('name',$telefono->name)}}">
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