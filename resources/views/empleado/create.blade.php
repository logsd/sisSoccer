@extends('template')

@section('title', 'Crear Empleado')

@push('css')
    <style>
        #description {
            resize: none;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

@endpush

@section('content')

<style>
    #description {
        resize: none;
    }

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
        padding: 8px 15px 8px 15px;
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
    <h1 class="mt-4 text-center mb-4">Crear Empleado</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('empleados.index')}}">Empleados</a> </li>
        <li class="breadcrumb-item active">Crear Empleados</li>
    </ol>
    <div class="cuerpo">
        <form action="{{route('empleados.store')}}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="ci" class="form-label">Cedula:</label>
                    <input type="number" name="ci" id="ci" class="form-control" value="{{old('ci')}}">
                    @error('ci')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                    @error('name')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label for="last_name" class="form-label">Apellido:</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        value="{{old('last_name')}}">
                    @error('last_name')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6 mb-2">
                    <label for="sex" class="form-label">Género:</label>
                    <select title="Seleccione una Categoria" name="sex" id="sex"
                        class="form-control selectpicker show-tick">
                        <option value="1" {{ old('sex') == '1' ? 'selected' : '' }}>Varonil</option>
                        <option value="0" {{ old('sex') == '0' ? 'selected' : '' }}>Femenino</option>
                    </select>
                    @error('sex')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                <label for="birth_date" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control"
                        value="{{old('birth_date')}}">
                    @error('birth_date')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label" for="civil_status_id">Estado Civil</label>
                    <select data-size="4" title="Seleccione un estado civil" data-live-search="true"
                        name="civil_status_id" id="civil_status_id" class="form-control selectpicker show-tick">
                        @foreach ($estadosCiviles as $item)
                            <option value="{{$item->id}}" {{old('civil_status_id') == $item->id ? 'selected' : ''}}>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('civil_status_id')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                    @error('email')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="direction" class="form-label">Dirección:</label>
                    <input type="text" name="direction" id="direction" class="form-control"
                        value="{{old('direction')}}">
                    @error('direction')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label" for="province_id">Provincia</label>
                    <select data-size="4" title="Seleccione una Provincia" data-live-search="true" name="province_id"
                        id="province_id" class="form-control selectpicker show-tick">
                        @foreach ($provincias as $item)
                            <option value="{{$item->id}}" {{old('province_id') == $item->id ? 'selected' : ''}}>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('province_id')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6 mb-2">
<<<<<<< HEAD
                                <label for="sex">Género:</label>
                                <select title="Seleccione un Genero" name="sex" id="sex" class="form-control selectpicker show-tick">
                                    <option value="1" {{ old('sex') == '1' ? 'selected' : '' }}>Varonil</option>
                                    <option value="0" {{ old('sex') == '0' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('sex')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                </div>

                <div class="col-md-12">
                    <label for="birth_date" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{old('birth_date')}}">
                    @error('birth_date')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="direction" class="form-label">Dirección:</label>
                    <input type="text" name="direction" id="direction" class="form-control" value="{{old('direction')}}">
                    @error('direction')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                

                <div class="col-md-12">
=======
>>>>>>> 90b7595c7272dd63a34f72ab37a566ae98faca77
                    <label for="f_income" class="form-label">Fecha de Inicio:</label>
                    <input type="date" name="f_income" id="f_income" class="form-control" value="{{old('f_income')}}">
                    @error('f_income')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="f_exit" class="form-label">Fecha de Salida:</label>
                    <input type="date" name="f_exit" id="f_exit" class="form-control" value="{{old('f_exit')}}">
                    @error('f_exit')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label" for="department_id">Departamento</label>
                    <select data-size="4" title="Seleccione un Departamento" data-live-search="true"
                        name="department_id" id="department_id" class="form-control selectpicker show-tick">
                        @foreach ($departamentos as $item)
                            <option value="{{$item->id}}" {{old('department_id') == $item->id ? 'selected' : ''}}>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label" for="position_id">Posicion</label>
                    <select data-size="4" title="Seleccione una Posicion" data-live-search="true" name="position_id"
                        id="position_id" class="form-control selectpicker show-tick">
                        @foreach ($posiciones as $item)
                            <option value="{{$item->id}}" {{old('position_id') == $item->id ? 'selected' : ''}}>
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('position_id')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>



                <div class="col-12 text-center">
                    <div class="row text-center">
                        <div class="col-md-12 mb-2 mt-2">
                            <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                            <a href="{{route('empleados.index')}}">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    @endpush
