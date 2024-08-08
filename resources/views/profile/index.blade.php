@extends('template')

@section('title', 'Perfil')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
@if (session('success') || session('error'))
<script>
    let message = "{{ session('success') ?? session('error') }}";
    let icon = "{{ session('success') ? 'success' : 'error' }}";

    Swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        icon: icon,
        title: message,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
</script>



@endif

<style>
    #observation {
        resize: none;
    }

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

    .dt {
        border-left: solid 2px black;
        padding-left: 6%;

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
        padding: 8px 20px 8px 20px;
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

<div class="container">
<ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Perfil</li>
    </ol>
    <h1 class="my-4 text-center">Configurar Perfil</h1>
    <div class="cuerpo">
    <form  class="card-body" action="{{route('profile.update',['profile'=>$user])}} " method="POST">
        @method('PATCH')
        @csrf

        <div class="row mb-4">
            <div class="mt-4">
            @if ($errors->any())
            @foreach ($errors->all() as $item)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{$item}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
            @endif
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-text">
                    <i class="fa-solid fa-square-check"></i>
                    </span>
                    <input disabled type="text"  value="Nombres" class="form-control">
                </div>
            </div>
            <div class="col-sm-8">
                <input type="text" name="name" id="name" value="{{old('name',$user->name)}}" class="form-control">
            </div>
        </div>


        <div class="row mb-4">

            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-text">
                    <i class="fa-solid fa-square-check"></i>
                    </span>
                    <input disabled type="text"  value="Email" class="form-control">
                </div>
            </div>
            <div class="col-sm-8">
                <input type="email" name="email" id="email" value="{{old('email',$user->email)}}" class="form-control">
            </div>
        </div>


        <div class="row mb-4">
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-text">
                    <i class="fa-solid fa-square-check"></i>
                    </span>
                    <input disabled type="text"  value="Password" class="form-control">
                </div>
            </div>
            <div class="col-sm-8">
                <input type="password" name="password" id="password"  class="form-control">
            </div>
        </div>
        <div class="row text-center mt-4">
                            <div class="col-md-12 mb-2 ">
                                <button type="submit" class="buttong"><i class="fa-solid fa-check"></i> Guardar</button>
                                <a href="{{route('home')}}">
                                    <button type="button" class="buttonr"><i
                                            class="fa-solid fa-arrow-left"></i>Cancelar</button>
                                </a>

                            </div>
                        </div>

    </form>
    </div>
</div>

@endsection

@push('js')

@endpush
