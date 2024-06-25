@extends('template')

@section('title', 'Crear Club')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Crear Clubs</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('clubs.index')}}">Clubs</a> </li>
                            <li class="breadcrumb-item active">Crear Clubs</li>
                        </ol>
<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('clubs.store')}}" method="post" enctype="multipart/form-data">
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
                <label for="trade_name" class="form-label">Nombre Comercial:</label>
                <input type="text" name="trade_name" id="trade_name" class="form-control" value="{{old('trade_name')}}">
                @error('trade_name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-6">
                <label for="reason_social" class="form-label">Razón Social:</label>
                <input type="text" name="reason_social" id="reason_social" class="form-control" value="{{old('reason_social')}}">
                @error('reason_social')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
                <label for="ruc" class="form-label">RUC:</label>
                <input type="number" name="ruc" id="ruc" class="form-control" value="{{old('ruc')}}">
                @error('ruc')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-6">
                <label for="direction" class="form-label">Dirección:</label>
                <input type="text" name="direction" id="direction" class="form-control" value="{{old('direction')}}">
                @error('direction')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                @error('email')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-6">
                <label for="date_constion" class="form-label">Fecha Elaborado:</label>
                <input type="date" name="date_constion" id="date_constion" class="form-control" value="{{old('date_constion')}}">
                @error('date_constion')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        
        <div class="col-md-6">
                <label for="direction_web" class="form-label">Dirección Web:</label>
                <input type="text" name="direction_web" id="direction_web" class="form-control" value="{{old('direction_web')}}">
                @error('direction_web')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        
        <div class="col-md-6">
                <label for="slogan" class="form-label">Slogan:</label>
                <input type="text" name="slogan" id="slogan" class="form-control" value="{{old('slogan')}}">
                @error('slogan')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        
        <div class="col-md-6">
                <label for="logo" class="form-label">Logo:</label>
                <input type="file" name="logo" id="logo" class="form-control" accept="Image/*">
                @error('logo')
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

        <div class="col-md-6">
                <label for="parish" class="form-label">Parroquia:</label>
                <input type="text" name="parish" id="parish" class="form-control" value="{{old('parish')}}">
                @error('parish')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
        <div class="form-check form-switch">
            <label class="form-check-label" for="vg">Actual</label>
             <input  name="current" class="form-check-input" type="checkbox" role="switch" id="current" value="1" {{ old('current') ? 'checked' : '' }}>
                @error('current')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>
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