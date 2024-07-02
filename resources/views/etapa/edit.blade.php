@extends('template')

@section('title', 'Editar Etapa')

@push('css')
<style>
    #description {
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Etapa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item "><a href="{{route('etapas.index')}}">Etapas</a> </li>
        <li class="breadcrumb-item active">Editar Etapa</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('etapas.update',['etapa'=>$etapa])}}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-3">
                <div class="col-md-6 mb-2">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name',$etapa->name)}}">
                    @error('name')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Descripción:</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$etapa->description)}}</textarea>
                    @error('description')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label" for="league_executive_id">Ejecutivo</label>
                    <select data-size="4" title="Seleccione un Ejecutivo" data-live-search="true" name="league_executive_id" id="league_executive_id" class="form-control selectpicker show-tick">
                        @foreach ($ejecutivos as $item)
                        @if ($etapa->league_executive_id == $item->id)
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