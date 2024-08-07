@extends('template')

@section('title', 'Ejecutivo')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')
@if (session('success'))
<script>
    let message = "{{session('success')}}";
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: message
    });
</script>
@endif

<style>
    .button {
        background-color: #4EA93B;
        color: black;
        padding: 8px 15px 8px 15px;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .button:hover {
        background-color: #337326;
        color: white;
    }

    .fa-plus {
        padding-right: 10px;
    }

    .card-header {
        background-color: #1A320F;
        color: white;
    }

    .btn {
        padding: 6px 15px 6px 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin: 0 5px 0 0;
    }

    .modal-header,
    .buttonc {
        background-color: #4EA93B;
        color: white;
        font-size: 110%;
        border: none;
    }
</style>

<div class="container-fluid px-4">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Ejecutivos</li>
    </ol>
    <h1 class="my-4 text-center ">Ejecutivos</h1>
    @can('crear-ejecutivo')
    <div class="mb-4">
        <a href="{{route('ejecutivos.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nuevo Ejecutivo</button>
        </a>
    </div>
    @endcan
    <div class="card mb-4">
        <div class="card-header">
            Tabla Ejecutivos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ejecutivos as $ejecutivo)
                    <tr>
                        <td>
                            {{$ejecutivo->dni}}
                        </td>
                        <td>
                            {{$ejecutivo->name}}
                        </td>
                        <td>
                            {{$ejecutivo->lastname}}
                        </td>
                        <td>
                            {{$ejecutivo->address}}
                        </td>
                        <td>
                            {{$ejecutivo->email}}
                        </td>
                        <td>
                            @if ($ejecutivo->state == 1)
                            <span class="fw-bolder p-1 rounded bg-info text-black">Habilitado</span>
                            @else
                            <span class="fw-bolder p-1 rounded bg-warning text-black">Deshabilitado</span>

                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-success rounded" data-bs-toggle="modal" data-bs-target="#verModal-{{$ejecutivo->id}}"><i class="fa-solid fa-eye"></i></button>
                                @can('editar-ejecutivo')
                                <form action="{{route('ejecutivos.edit', ['ejecutivo' => $ejecutivo])}}" method="get">
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></button>
                                </form>
                                @endcan
                                @can('desabilizar-ejecutivo')
                                @if ($ejecutivo->state == 1)
                                <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$ejecutivo->id}}"><i class="fa-solid fa-toggle-off fa-xl"></i></button>
                                @else
                                <button type="button" class="btn btn-info rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$ejecutivo->id}}"><i class="fa-solid fa-toggle-on fa-xl"></i></button>
                                @endif
                                @endcan
                                @can('eliminar-ejecutivo')
                                <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$ejecutivo->id}}"><i class="fa-solid fa-trash"></i></button>
                                @endcan

                            </div>
                        </td>
                    </tr>
                    <!-- Modal Eliminar-->
                    <div class="modal fade" id="deleteModal-{{$ejecutivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Seguro que quieres eliminar este Ejecutivo?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{route('ejecutivos.forceDelete', [$ejecutivo->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Ver-->
                    <div class="modal fade" id="verModal-{{$ejecutivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ejecutivo Detalles</h1>
                                    <button type="button" class="buttonc" data-bs-dismiss="modal" aria-label="Close">X</button>
                                </div>
                                <div class="modal-body">

                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fa-solid fa-people-group"></i></span>
                                        <input disabled type="text" class="form-control" value="DNI:">
                                        <input disabled type="text" class="form-control  bg-white" value="{{$ejecutivo->dni}}">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                            <input disabled type="text" class="form-control" value="Nombre:">
                                            <input disabled type="text" class="form-control  bg-white" value="{{$ejecutivo->name}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                            <input disabled type="text" class="form-control" value="Apellido:">
                                            <input disabled type="text" class="form-control  bg-white" value="{{$ejecutivo->lastname}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                            <input disabled type="text" class="form-control" value="Direccion:">
                                            <input disabled type="text" class="form-control  bg-white" value="{{$ejecutivo->address}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                            <input disabled type="text" class="form-control" value="Email:">

                                        </div>
                                        <input disabled type="text" class="form-control mb-3 bg-white" value="{{$ejecutivo->email}}">
                                    </div>

                                    <div class="row mb-3">
                                        <label class="fw-bolder mb-3">Imagen:</label>
                                        <div>
                                            @if ($ejecutivo->img_path != null)
                                            <img src="{{ Storage::url('public/ejecutivos/' . $ejecutivo->img_path)}}" alt="{{$ejecutivo->name}}" class="img-fluid img-thumbnail border border-4 rounded">
                                            @else
                                            <img src="" alt="{{$ejecutivo->name}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal eliminar -->
                    <div class="modal fade" id="confirmModal-{{$ejecutivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {!! $ejecutivo->state == 1
                                    ? '¿Seguro que quieres <strong>Deshabilitar</strong> este Ejecutivo?'
                                    : '¿Seguro que quieres <strong>Habilitar</strong> este Ejecutivo?' !!}</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{route('ejecutivos.destroy', ['ejecutivo' => $ejecutivo->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn {{$ejecutivo->state == 1 ? 'btn-warning' : 'btn-info'}}">
                                            {{$ejecutivo->state == 1 ? 'Deshabilitar' : 'Habilitado'}}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

@endpush