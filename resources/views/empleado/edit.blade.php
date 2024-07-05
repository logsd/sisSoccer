@extends('template')

@section('title', 'Editar Empleado')

@push('css')
<style>
    #observation {
        resize: none;
    }

    #description {
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Empleado</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('empleados.index')}}">Empleados</a> </li>
        <li class="breadcrumb-item active">Editar Empleado</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
    <form action="{{route('empleados.update',['empleado'=>$empleado])}}" method="post">

            @method('PATCH')
            @csrf
            <div class="container mt-4">
                <div class="row gy-4">
                    <!--Editar Empleado--->
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles Empleado
                        </div>

                        <div class="row g-3">
                <div class="col-md-6 mb-2">
                    <label for="ci" class="form-label">Cedula:</label>
                    <input type="number" name="ci" id="ci" class="form-control" value="{{old('ci',$empleado->ci)}}">
                    @error('ci')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>        
                <div class="row g-3">
                <div class="col-md-6 mb-2">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name',$empleado->name)}}">
                    @error('name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="last_name" class="form-label">Apellido:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name',$empleado->last_name)}}">
                    @error('last_name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email',$empleado->email)}}">
                    @error('email')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                                <label for="sex">Género:</label>
                                <select title="Seleccione una Categoria" name="sex" id="sex" class="form-control selectpicker show-tick">
                                    <option value="1" {{ old('sex') == '1' ? 'selected' : '' }}>Varonil</option>
                                    <option value="0" {{ old('sex') == '0' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('sex')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                </div>

                <div class="col-md-12">
                    <label for="birth_date" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{old('birth_date',$empleado->birth_date)}}">
                    @error('birth_date')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="direction" class="form-label">Dirección:</label>
                    <input type="text" name="direction" id="direction" class="form-control" value="{{old('direction',$empleado->direction)}}">
                    @error('direction')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                

                <div class="col-md-12">
                    <label for="f_income" class="form-label">Fecha de Inicio:</label>
                    <input type="date" name="f_income" id="f_income" class="form-control" value="{{old('f_income',$empleado->f_income)}}">
                    @error('f_income')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="f_exit" class="form-label">Fecha de Salida:</label>
                    <input type="date" name="f_exit" id="f_exit" class="form-control" value="{{old('f_exit',$empleado->f_exit)}}">
                    @error('f_exit')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>


                <div class="col-md-6 mb-2">
                        <label class="form-label" for="province_id">Provincia</label>
                      <select data-size="4" title="Seleccione una Provincia" data-live-search="true" name="province_id" id="province_id" class="form-control selectpicker show-tick">
                        @foreach ($provincias as $item)
                            <option value="{{$item->id}}" {{old('province_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                      </select>
                        @error('province_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                </div>

                <div class="col-md-6 mb-2">
                        <label class="form-label" for="department_id">Departamento</label>
                      <select data-size="4" title="Seleccione un Departamento" data-live-search="true" name="department_id" id="department_id" class="form-control selectpicker show-tick">
                        @foreach ($departamentos as $item)
                            <option value="{{$item->id}}" {{old('department_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                      </select>
                        @error('department_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                </div>

                <div class="col-md-6 mb-2">
                        <label class="form-label" for="position_id">Posicion</label>
                      <select data-size="4" title="Seleccione una Posicion" data-live-search="true" name="position_id" id="position_id" class="form-control selectpicker show-tick">
                        @foreach ($posiciones as $item)
                            <option value="{{$item->id}}" {{old('position_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                      </select>
                        @error('position_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                </div>

                <div class="col-md-6 mb-2">
                        <label class="form-label" for="civil_status_id">Estado Civil</label>
                      <select data-size="4" title="Seleccione un estado civil" data-live-search="true" name="civil_status_id" id="civil_status_id" class="form-control selectpicker show-tick">
                        @foreach ($estadosCiviles as $item)
                            <option value="{{$item->id}}" {{old('civil_status_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                      </select>
                        @error('civil_status_id')
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