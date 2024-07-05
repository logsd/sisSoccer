@extends('template')

@section('title', 'Editar Telefono Club')

@push('css')
<style>
        #description {
                resize: none;
        }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
        <h1 class="mt-4">Editar Telefono Club</h1>
        <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                <li class="breadcrumb-item "><a href="{{route('dataClubs.index')}}">Telefono Club</a> </li>
                <li class="breadcrumb-item active">Editar Telefono Club</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
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
                                        <button type="submit" class="btn btn-success ">Actualizar</button>
                                        <button type="reset" class="btn btn-secondary">Reiniciar</button>
                                </div>
                        </div>
                </form>
        </div>
        @endsection

        @push('js')

        @endpush