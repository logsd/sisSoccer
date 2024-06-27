@extends('template')

@section('title', 'Editar Ejecutivo')

@push('css')
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Ejecutivos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('ejecutivos.index')}}">Ejecutivos</a> </li>
                            <li class="breadcrumb-item active">Editar Ejecutivo</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('ejecutivos.update',['ejecutivo'=>$ejecutivo])}}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="dni" class="form-label">DNI:</label>
                <input type="number" name="dni" id="dni" class="form-control" value="{{old('dni',$ejecutivo->dni)}}">
                @error('dni')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$ejecutivo->name)}}">
                @error('name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-6">
                <label for="lastname" class="form-label">Apellido:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{old('lastname',$ejecutivo->lastname)}}">
                @error('lastname')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-6">
                <label for="address" class="form-label">Address:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{old('address',$ejecutivo->address)}}">
                @error('address')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email',$ejecutivo->email)}}">
                @error('email')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>
        
        <div class="col-md-6">
                <label for="img_path" class="form-label">Imagen:</label>
                @if($ejecutivo->img_path)
                <div class="img-container">
                <img src="{{ Storage::url('public/ejecutivos/'. $ejecutivo->img_path)}}" alt="{{$ejecutivo->name}}" class="img-fluid img-thumbnail border border-4 rounded">
                </div>
            @endif
            <br>
                <input type="file" name="img_path" id="img_path" class="form-control" accept="Image/*">
                @error('img_path')
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