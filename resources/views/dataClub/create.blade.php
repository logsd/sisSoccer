@extends('template')

@section('title', 'Crear Telefono Club')

@push('css')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center mb-4">Nuevo Teléfono Club</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('dataClubs.index')}}">Teléfono Club</a> </li>
        <li class="breadcrumb-item active">Nuevo Teléfono Club</li>
    </ol>
    <div class="cuerpo">
        <form action="{{route('dataClubs.store')}}" method="post">
            @csrf
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="phone" class="form-label">Teléfono:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}">
                    @error('phone')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="operator" class="form-label">Operadora:</label>
                    <input type="text" name="operator" id="operator" class="form-control" value="{{old('operator')}}">
                    @error('operator')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>


                <div class="col-md-12">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                    @error('description')
                        <small class="text-danger">{{'*' . $message}}</small>
                    @enderror
                </div>



                <div class="col-md-6 mb-2">
                    <label class="form-label" for="club_id">Club</label>
                    <select data-size="4" title="Seleccione el Club" data-live-search="true" name="club_id" id="club_id"
                        class="form-control selectpicker show-tick">
                        @foreach ($clubs as $item)
                            <option value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('club_id')
                        <small class="text-danger">{{'*' . $message}}</small>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    @endpush
