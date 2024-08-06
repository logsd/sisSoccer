@extends('template')

@section('title', 'Actulizar Telefono General')

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
                        <ol class="breadcrumb my-4">
                            <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('genTelefonos.index')}}">Teléfono</a> </li>
                            <li class="breadcrumb-item active"> Actualizar Teléfono General</li>
                        </ol>
                        <h1 class="my-4 text-center"> Actualizar Teléfono General</h1>
                        <div class="cuerpo">
<form action="{{route('genTelefonos.update',['genTelefono'=>$genTelefono])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="number" class="form-label">Número:</label>
                <input type="text" name="number" id="number" class="form-control" value="{{old('number',$genTelefono->number)}}">
                @error('number')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{old('description',$genTelefono->description)}}">
                @error('description')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6 mb-2">
                    <label class="form-label" for="league_executive_id">Ejecutivo</label>
                    <select data-size="4" title="Seleccione un Ejecutivo" data-live-search="true" name="league_executive_id" id="league_executive_id" class="form-control selectpicker show-tick">
                        @foreach ($ejecutivos as $item)
                        @if ($genTelefono->league_executive_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('league_executive_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('league_executive_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('league_executive_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
        </div>


        <div class="col-md-6 mb-2">
                    <label class="form-label" for="employee_id">Empleado</label>
                    <select data-size="4" title="Seleccione un Empleado" data-live-search="true" name="employee_id" id="employee_id" class="form-control selectpicker show-tick">
                    @foreach ($empleados as $item)
                        @if ($genTelefono->employee_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('employee_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('employee_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('employee_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
        </div>

        <div class="row text-center mt-4">
                            <div class="col-md-12 mb-2 ">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('genTelefonos.index')}}">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush
