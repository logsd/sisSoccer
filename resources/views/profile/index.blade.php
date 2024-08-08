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
<div class="container">
    <h1 class="mt-4 text-center">Configurar Perfil</h1>
    <div class="container card mt-4">
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
    <div class="col text-center">
        <input type="submit" class="btn btn-success" value="Guardar Cambios">
    </div>

    </form>
    </div>
</div>

@endsection

@push('js')

@endpush