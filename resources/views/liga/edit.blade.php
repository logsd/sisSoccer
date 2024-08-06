@extends('template')

@section('title', 'Editar Liga')

@push('css')
<style>
    #observation {
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Ligas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('ligas.index')}}">Ligas</a> </li>
        <li class="breadcrumb-item active">Editar Liga</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('ligas.update',['liga'=>$liga])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name',$liga->name)}}">
                    @error('name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="trade_name" class="form-label">Nombre Corto:</label>
                    <input type="text" name="trade_name" id="trade_name" class="form-control" value="{{old('trade_name',$liga->trade_name)}}">
                    @error('trade_name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="business_name" class="form-label">Nombre Del Negocio:</label>
                    <input type="text" name="business_name" id="business_name" class="form-control" value="{{old('business_name',$liga->business_name)}}">
                    @error('business_name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="ruc" class="form-label">RUC:</label>
                    <input type="number" name="ruc" id="ruc" class="form-control" value="{{old('ruc',$liga->ruc)}}">
                    @error('ruc')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="direction" class="form-label">Dirección:</label>
                    <input type="text" name="direction" id="direction" class="form-control" value="{{old('direction',$liga->direction)}}">
                    @error('direction')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email',$liga->email)}}">
                    @error('email')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="constitution_date" class="form-label">Fecha Elaborado:</label>
                    <input type="date" name="constitution_date" id="constitution_date" class="form-control" value="{{old('constitution_date',$liga->constitution_date)}}">
                    @error('constitution_date')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="direction_web" class="form-label">Dirección Web:</label>
                    <input type="text" name="direction_web" id="direction_web" class="form-control" value="{{old('direction_web',$liga->direction_web)}}">
                    @error('direction_web')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="url_logo" class="form-label">Logo:</label>
                    <input type="file" name="url_logo" id="url_logo" class="form-control" accept="Image/*">
                    @error('url_logo')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="url_sello" class="form-label">Sello:</label>
                    <input type="file" name="url_sello" id="url_sello" class="form-control" accept="Image/*">
                    @error('url_sello')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$liga->description)}}</textarea>
                    @error('description')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="slogan" class="form-label">Slogan:</label>
                    <input type="text" name="slogan" id="slogan" class="form-control" value="{{old('slogan',$liga->slogan)}}">
                    @error('slogan')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label" for="taxpayer_id">Contribuyente</label>
                    <select data-size="4" title="Seleccione un Club" data-live-search="true" name="taxpayer_id" id="taxpayer_id" class="form-control selectpicker show-tick">
                        @foreach ($contribuyentes as $item)
                        @if ($liga->taxpayer_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('taxpayer_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('taxpayer_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('taxpayer_id')
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
    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    @endpush