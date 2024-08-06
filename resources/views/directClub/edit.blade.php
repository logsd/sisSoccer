@extends('template')

@section('title', 'Actualizar Directivo')

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
        padding-left: 5%;
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
        background-color: #1A320F;
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
        <li class="breadcrumb-item "><a href="{{route('directClubs.index')}}"> Directivos</a> </li>
        <li class="breadcrumb-item active">Actualizar Directivo</li>
    </ol>
    <h1 class="my-4 text-center">Actualizar Directivo</h1>
    <div class="container">
        <form action="{{route('directClubs.update', ['directClub' => $directClub])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="cuerpo">
                <div class="row gy-4">
                    <!--Crear Directivo--->
                    <div class="col-md-8">
                        <div>
                            <h4> Detalles Directivo</h4>
                            <div class="col-md-12 mb-2">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$directClub->name)}}">
                                @error('name')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="observation" class="form-label">Observación:</label>
                                <textarea name="observation" id="observation" rows="3" class="form-control">{{old('observation',$directClub->observation)}}</textarea>
                                @error('observation')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{old('email',$directClub->email)}}">
                                    @error('email')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-2">
                                    <label for="phone" class="form-label">Teléfono:</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone',$directClub->phone)}}">
                                    @error('phone')
                                    <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Dato-->
                    <div class="col-md-4">
                        <div class="dt ">
                            <div class="row">
                                <h5 class="text-center">Datos Adicionales</h5>
                                <div class="col-md-12 mb-2">
                                    <label for="position" class="form-label ">Posición:</label>
                                    <input type="text" name="position" id="position" class="form-control border-success" value="{{old('position',$directClub->position)}}">
                                    @error('position')
                                    <small class="text-danger">{{'*' . $message}}</small>
                                    @enderror
                                </div>
                                <div class="row">
                                    <h6 class="my-4"> <strong>Asignar Club/Campeonato</strong></h6>

                                    <div class="col-md-12 mb-2">
                                        <label class="form-label" for="club_id">Club:</label>
                                        <select data-size="3" title="Seleccione un Club" data-live-search="true" name="club_id" id="club_id" class="form-control selectpicker show-tick">
                                            @foreach ($clubs as $item)
                                            @if ($directClub->club_id == $item->id)
                                            <option selected value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                                            @else
                                            <option value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('club_id')
                                        <small class="text-danger">{{'*' . $message}}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-12 mb-2">
                                        <label class="form-label" for="championship_id">Campeonato:</label>
                                            <select data-size="3" title="Seleccione un Campeonato" data-live-search="true" name="championship_id" id="championship_id" class="form-control selectpicker show-tick">
                                                @foreach ($campeonatos as $item)
                                                @if ($directClub->championship_id == $item->id)
                                                <option selected value="{{$item->id}}" {{old('championship_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @else
                                                <option value="{{$item->id}}" {{old('championship_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('championship_id')
                                            <small class="text-danger">{{'*' . $message}}</small>
                                            @enderror
                                    </div>



                                </div>
                            </div>

                        </div>
                        <div class="row text-center">
                                <div class="col-md-12 mb-2 mt-4">
                                    <button type="submit" class="buttong"><i class="fa-solid fa-check"></i>Guardar</button>
                                    <a href="{{route('directClubs.index')}}">
                                        <button type="button" class="buttonr"><i class="fa-solid fa-arrow-left"></i>Cancelar</button>
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
