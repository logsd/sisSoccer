@extends('template')

@section('title', 'Actulizar Contribuyente')

@push('css')
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
        padding: 8px 15px 8px 15px;
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
@endpush

@section('content')
<div class="container-fluid px-4">
                        <ol class="breadcrumb my-4">
                            <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
                            <li class="breadcrumb-item "><a href="{{route('contribuyentes.index')}}">Contribuyentes</a> </li>
                            <li class="breadcrumb-item active">Actulizar Contribuyente</li>
                        </ol>
                        <h1 class="my-4 text-center">Actulizar Contribuyente</h1>
                        <div class="cuerpo">
<form action="{{route('contribuyentes.update',['contribuyente'=>$contribuyente])}}" method="post">
    @method('PATCH')
    @csrf
    <div class="row g-3">

<div class="col-md-6">
        <label for="name" class="form-label">Nombre:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{old('name',$contribuyente->name)}}">
        @error('name')
        <small class="text-danger">{{'*'.$message}}</small>
        @enderror
</div>

<div class="col-md-12">
                <label for="description" class="form-label">Descripción:</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{old('description',$contribuyente->description)}}</textarea>
                @error('description')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
        </div>


<div class="col-md-6">
        <div class="form-check form-switch">
        <input type="hidden" name="a_cont" value="0">
            <label class="form-check-label" for="a_cont">A Cont</label>
             <input  name="a_cont" class="form-check-input" type="checkbox" role="switch" id="a_cont" value="1" {{ old('a_cont', $contribuyente->a_cont) ? 'checked' : '' }}>
                @error('a_cont')
                <small class="text-danger">{{'*'.$message}}</small>
                @enderror
</div>
</div>

<div class="col-12 text-center">
                    <div class="row text-center">
                        <div class="col-md-12 mb-2 mt-2">
                            <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                            <a href="{{route('contribuyentes.index')}}">
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
