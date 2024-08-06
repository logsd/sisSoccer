@extends('template')

@section('title', 'Actualizar Estado')

@push('css')
<style>
        #description {
        resize: none;
    }

    .d-none {
        display: none;
    }

    .cuerpo {
        border: solid 3px black;
        border-radius: 10px;
        padding: 20px;
        background: #4EA93B;
        color: black;
        margin-bottom: 20px
    }

    .dt {
        border-left: solid 2px black;
        padding-left: 6%;

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
@endpush

@section('content')
<div class="container-fluid px-4">
                        <ol class="breadcrumb my-4">
                            <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('estados.index')}}">Estados</a> </li>
                            <li class="breadcrumb-item active">Actualizar Estado</li>
                        </ol>
                        <h1 class="my-4 text-center">Actualizar Estado</h1>
                        <div class="cuerpo">
<form action="{{route('estados.update',['estado'=>$estado])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$estado->name)}}">
                @error('name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6">
                <label for="process" class="form-label">Proceso:</label>
                <input type="text" name="process" id="process" class="form-control" value="{{old('process',$estado->process)}}">
                @error('process')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


        <div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$estado->description)}}</textarea>
                @error('description')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="row text-center mt-4">
                            <div class="col-md-12 mb-2 ">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('estados.index')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Cancelar</button>
                                </a>

                            </div>
                        </div>
    </div>
</form>
</div>
</div>
@endsection

@push('js')

@endpush
