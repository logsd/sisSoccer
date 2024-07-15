@extends('template')

@section('title', 'Editar OficinaGeneral')

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
                        <h1 class="mt-4">Editar Oficina General</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('genOficinas.index')}}">Oficina General</a> </li>
                            <li class="breadcrumb-item active">Editar Oficina General</li>
                        </ol>

                        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
<form action="{{route('genOficinas.update',['genOficina'=>$genOficina])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

    <div class="col-md-6">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$genOficina->name)}}">
                @error('name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>
    
    <div class="col-md-6">
                <label for="short_name" class="form-label">Nombre Corto:</label>
                <input type="text" name="short_name" id="short_name" class="form-control" value="{{old('short_name',$genOficina->short_name)}}">
                @error('short_name')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

    <div class="col-md-6">
                <label for="address" class="form-label">Direccion:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{old('address',$genOficina->address)}}">
                @error('address')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>

        <div class="col-md-6 mb-2">
                    <label class="form-label" for="report_id">Reporte:</label>
                    <select data-size="4" title="Seleccione un Reporte" data-live-search="true" name="report_id" id="report_id" class="form-control selectpicker show-tick">
                        @foreach ($reportes as $item)
                        @if ($genOficina->report_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('report_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('report_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('report_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
        </div>


        <div class="col-md-6 mb-2">
                    <label class="form-label" for="commission_league_id">Comisiones:</label>
                    <select data-size="4" title="Seleccione una Comision" data-live-search="true" name="commission_league_id" id="commission_league_id" class="form-control selectpicker show-tick">
                    @foreach ($comisiones as $item)
                        @if ($genOficina->commission_league_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('commission_league_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('commission_league_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('commission_league_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
        </div>

        <div class="col-md-6 mb-2">
                    <label class="form-label" for="charge_id">Cargos:</label>
                    <select data-size="4" title="Seleccione un Cargo" data-live-search="true" name="charge_id" id="charge_id" class="form-control selectpicker show-tick">
                    @foreach ($cargas as $item)
                        @if ($genOficina->charge_id == $item->id)
                        <option selected value="{{$item->id}}" {{old('charge_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>

                        @else
                        <option value="{{$item->id}}" {{old('charge_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('charge_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
        </div>

        <div class="col-md-6 mb-2">
                    <label class="form-label" for="championship_id">Club:</label>
                    <select data-size="4" title="Seleccione un Club" data-live-search="true" name="club_id" id="club_id" class="form-control selectpicker show-tick">
                    @foreach ($clubs as $item)
                        @if ($genOficina->club_id == $item->id)
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