@extends('template')

@section('title', 'Crear Telefono Club')

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
        <h1 class="mt-4">Crear Telefono Club</h1>
        <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                <li class="breadcrumb-item "><a href="{{route('clubs.index')}}">Telefono Club</a> </li>
                <li class="breadcrumb-item active">Crear Telefono Club</li>
        </ol>
        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
                <form action="{{route('dataClubs.store')}}" method="post">
                        @csrf
                        <div class="row g-3">

                                <div class="col-md-6">
                                        <label for="phone" class="form-label">Telefono:</label>
                                        <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}">
                                        @error('phone')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>


                                <div class="col-md-6">
                                        <label for="operator" class="form-label">Operadora:</label>
                                        <input type="text" name="operator" id="operator" class="form-control" value="{{old('operator')}}">
                                        @error('operator')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>


                                <div class="col-md-12">
                                        <label for="description" class="form-label">Descripción:</label>
                                        <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                                        @error('description')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>



                                <div class="col-md-6 mb-2">
                                        <label class="form-label" for="club_id">Club</label>
                                        <select data-size="4" title="Seleccione el Club" data-live-search="true" name="club_id" id="club_id" class="form-control selectpicker show-tick">
                                                @foreach ($clubs as $item)
                                                <option value="{{$item->id}}" {{old('club_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                        </select>
                                        @error('club_id')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                        @enderror
                                </div>
                                <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-success ">Guardar</button>
                                </div>
                        </div>
                </form>
        </div>
        @endsection

        @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

        @endpush