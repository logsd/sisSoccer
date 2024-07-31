@extends('template')

@section('title', 'Nuevo Club')

@push('css')

@endpush

<style>
        #description {
                resize: none;
        }

    .container{
        background-color:  #4EA93B;
    }


    .fa-check, .fa-arrow-left{
        padding-right:15px;
    }
</style>

@section('content')

<style>
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
        padding: 8px 15px 8px 15px;
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
                <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                <li class="breadcrumb-item "><a href="{{route('clubs.index')}}">Clubs</a> </li>
                <li class="breadcrumb-item active">Nuevo Club</li>
        </ol>
        <h1 class="my-4 text-center">Nuevo Club</h1>
        <div class="container w-100 border border-3 border-black rounded p-4 mt-3">
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

                                <div class="col-12 text-center">
        <div class="row text-center">
                            <div class="col-md-12 mb-2 mt-2">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('dataClubs.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Regresar</button>
                                </a>
                                <div class="col-md-12 mb-2">
                                </div>
                            </div>
                        </div>
        </div>
                        </div>
                </form>
        </div>
        @endsection

        @push('js')

        @endpush
