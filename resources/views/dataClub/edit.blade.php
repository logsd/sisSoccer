@extends('template')

@section('title', 'Editar Telefono Club')

@push('css')
<style>
    #description{
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
            background-color: #d11500;
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
        <h1 class="mt-4 text-center mb-3">Editar Telefono Club</h1>
        <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                <li class="breadcrumb-item "><a href="{{route('dataClubs.index')}}">Telefono Club</a> </li>
                <li class="breadcrumb-item active">Editar Telefono Club</li>
        </ol>

        <div class="cuerpo">
                <form action="{{route('dataClubs.update',['dataClub'=>$dataClub])}}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="row g-3">

                                <div class="col-md-6">
                                        <label for="phone" class="form-label">Telefono:</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone',$dataClub->phone)}}">
                                        @error('phone')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>


                                <div class="col-md-6">
                                        <label for="operator" class="form-label">Operadora:</label>
                                        <input type="text" name="operator" id="operator" class="form-control" value="{{old('operator',$dataClub->operator)}}">
                                        @error('operator')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>


                                <div class="col-md-12">
                                        <label for="description" class="form-label">Descripción:</label>
                                        <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$dataClub->description)}}</textarea>
                                        @error('description')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>



                                <div class="col-md-6 mb-2">
                                        <label class="form-label" for="club_id">Club</label>
                                        <select data-size="4" title="Seleccione un Club" data-live-search="true" name="club_id" id="club_id" class="form-control selectpicker show-tick">
                                                @foreach ($clubs as $item)
                                                @if ($dataClub->club_id == $item->id)
                                                <option selected value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                                                @else
                                                <option value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endif
                                                @endforeach
                                        </select>
                                        @error('club_id')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>

                                <div class="col-12 text-center">
                    <div class="row text-center">
                        <div class="col-md-12 mb-2 mt-2">
                            <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                            <a href="{{route('dataClubs.index')}}">
                                <button type="button" class="buttonr"><i
                                        class="fa-solid fa-arrow-left"></i>Cancelar</button>
                            </a>
                            <div class="col-md-12 mb-2">
                            </div>
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
