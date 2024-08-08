@extends('template')

@section('title', 'Crear Liga')

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


<style>
    #description {
        resize: none;
    }

    .cuerpo {
        border: solid 3px black;
        border-radius: 10px;
        padding: 20px;
        background: #4EA93B;
        color: black;
        margin-bottom: 20px
    }

    h4 {
        text-align: center;
        padding: 4px 5px;
    }

    .buttong {
        background-color: #32fc08;
        color: black;
        padding: 8px 20px 8px 20px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
    }

    .buttonr {
        background-color: #A5D29A;
        color: black;
        padding: 8px 20px 8px 20px;
        margin-left: 10px;
        border: solid 2px black;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        font-size: 17px;
    }

    .buttonr:hover,
    .buttong:hover {
        background-color: #337326;
        color: white;

    }

    .fa-check,
    .fa-arrow-left {
        padding-right: 10px;
    }
</style>

<div class="container-fluid px-4">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('ligas.index')}}">Ligas</a> </li>
        <li class="breadcrumb-item active">Nueva Liga</li>
    </ol>
    <h1 class="my-4 text-center">Nueva Liga</h1>
    <div class="cuerpo">
        <form action="{{route('ligas.store')}}" method="post" enctype="multipart/form-data">
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
                    <label for="trade_name" class="form-label">Nombre Corto:</label>
                    <input type="text" name="trade_name" id="trade_name" class="form-control" value="{{old('trade_name')}}">
                    @error('trade_name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="business_name" class="form-label">Nombre Del Negocio:</label>
                    <input type="text" name="business_name" id="business_name" class="form-control" value="{{old('business_name')}}">
                    @error('business_name')
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
                    <label for="constitution_date" class="form-label">Fecha Elaborado:</label>
                    <input type="date" name="constitution_date" id="constitution_date" class="form-control" value="{{old('constitution_date')}}">
                    @error('constitution_date')
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
                    <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                    @error('description')
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


                <div class="col-md-6 mb-2">
                    <label class="form-label" for="taxpayer_id">Contribuyente:</label>
                    <select data-size="3" title="Seleccione un Contribuyente" data-live-search="true" name="taxpayer_id" id="taxpayer_id" class="form-control selectpicker show-tick">
                        @foreach ($contribuyentes as $item)
                        <option value="{{$item->id}}" {{old('taxpayer_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('taxpayer_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-12 text-center">
                    <div class="row text-center">
                        <div class="col-md-12 mb-2 mt-2">
                            <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                            <a href="{{route('ligas.index')}}">
                                <button type="button" class="buttonr"><i
                                        class="fa-solid fa-arrow-left"></i>Regresar</button>
                            </a>
                            <div class="col-md-12 mb-2">
                            </div>
                        </div>


            </div>
        </form>
    </div>
    @endsection

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    @endpush
