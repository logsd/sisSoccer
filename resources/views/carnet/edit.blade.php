@extends('template')

@section('title', 'Editar Carnet')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Carnet</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('carnets.index')}}">Carnet</a> </li>
                            <li class="breadcrumb-item active">Editar Carnet</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('carnets.update',['carnet'=>$carnet])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="cod" class="form-label">Codigo:</label>
                <input type="text" name="cod" id="cod" class="form-control" value="{{old('cod',$carnet->cod)}}">
                @error('cod')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6 mb-2">
                    <label class="form-label" for="player_id">Jugador:</label>
                    <select data-size="4" title="Seleccione un Jugador" data-live-search="true" name="player_id" id="player_id" class="form-control selectpicker show-tick">
                        @foreach ($jugadores as $item)
                        @if ($carnet->player_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('player_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('player_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('player_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
        </div>


        <div class="col-md-6 mb-2">
                    <label class="form-label" for="championship_id">Campeonato:</label>
                    <select data-size="4" title="Seleccione un Campeonato" data-live-search="true" name="championship_id" id="championship_id" class="form-control selectpicker show-tick">
                    @foreach ($campeonatos as $item)
                        @if ($carnet->championship_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('championship_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('championship_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('championship_id')
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
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush