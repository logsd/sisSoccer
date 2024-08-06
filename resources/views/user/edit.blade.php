@extends('template')

@section('title', 'Actualizar Usuario')

@push('css')

@endpush

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
        background-color:#A5D29A;
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
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
<<<<<<< HEAD
        <li class="breadcrumb-item "><a href="{{route('users.index')}}">Usuarios</a> </li>
        <li class="breadcrumb-item active">Actualizar Usuario</li>
=======
        <li class="breadcrumb-item "><a href="{{route('departamentos.index')}}">Departamentos</a> </li>
        <li class="breadcrumb-item active">Actualizar Departamento</li>
>>>>>>> 3bab08a9d882f7cf47267e182088a584e23e757d
    </ol>
    <h1 class="my-4 text-center">Actualizar Usuarios</h1>
    <div class="cuerpo">
        <form action="{{route('users.update', ['user' => $user])}}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-3">
            <div class="row mb-4 mt-4">
                    <label for="name" class="col-sm-2 col-form-label">Nombres:</label>
                    <div class="col-sm-4">
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name',$user->name)}}">
                    </div>
                    <div class="sol-sm-4">
                        <div class="form-text">
                            Escriba un solo nombre
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('name')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4 mt-4">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                        <input type="email" name="email" id="email" class="form-control" value="{{old('email',$user->email)}}">
                    </div>
                    <div class="sol-sm-4">
                        <div class="form-text">
                            Escriba una dirección de Correo Electronico
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('email')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>
                

                <div class="row mb-4 mt-4">
                    <label for="password" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-4">
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="sol-sm-4">
                        <div class="form-text">
                            Escriba un password seguro, incluya numeros!
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('password')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>


                <div class="row mb-4 mt-4">
                    <label for="password_confirm" class="col-sm-2 col-form-label">Confirmar Password:</label>
                    <div class="col-sm-4">
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                    </div>
                    <div class="sol-sm-4">
                        <div class="form-text">
                            Vuelva a escribir su contraseña
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('password_confirm')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>


                <div class="row mb-4 mt-4">
                    <label for="email" class="col-sm-2 col-form-label">Seleccionar rol:</label>
                    <div class="col-sm-4">
                        <select name="role" id="role" class="form-select">
                            @foreach ($roles as $item )
                           
                            @if (in_array($item->name,$user->roles->pluck('name')->toArray()))
                            <option selected value="{{$item->name}}" @selected(old('role') == $item->name)>{{$item->name}}</option>
                            @else
                            <option value="{{$item->name}}" @selected(old('role') == $item->name)>{{$item->name}}</option>
                            @endif

                            @endforeach
                        </select>
                    </div>
                    <div class="sol-sm-4">
                        <div class="form-text">
                        Seleccione un rol
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('role')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-12 text-center">
                    <div class="row text-center">
                        <div class="col-md-12 mb-2 mt-2">
                            <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Actualizar</button>
                            <a href="{{route('users.index')}}">
                                <button type="button" class="buttonr"><i
                                        class="fa-solid fa-arrow-left"></i>Cancelar</button>
                            </a>
                            <div class="col-md-12 mb-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
