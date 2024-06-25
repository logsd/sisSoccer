@extends('template')

@section('title', 'Crear Departamento')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Crear Departamentos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('departamentos.index')}}">Departamentos</a> </li>
                            <li class="breadcrumb-item active">Crear Departamentos</li>
                        </ol>
<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('departamentos.store')}}" method="post">
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