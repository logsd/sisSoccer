@extends('template')

@section('title', 'Empleados')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
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
        <li class="breadcrumb-item active">Empleados</li>
    </ol>

    <h1 class="my-4 text-center">Empleados</h1>
    <div class="mb-4">
        <a href="{{route('empleados.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nuevo Empleado</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Tabla Empleado
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($empleados as $empleado )
                    <tr>
                        <td>
                            {{$empleado->ci}}
                        </td>
                        <td>
                            {{$empleado->name}}
                        </td>
                        <td>
                            {{$empleado->last_name}}
                        </td>
                        <td>
                            {{$empleado->email}}
                        </td>
                        <td>
                            {{$empleado->direction}}
                        </td>

                                                <td>
                                                    @if ($empleado->state == 1)
                                                    <span class="fw-bolder p-1 rounded bg-info text-black">Habilitado</span>
                                                    @else
                                                    <span class="fw-bolder p-1 rounded bg-warning text-black">Deshabilitado</span>

                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            <form action="{{route('empleados.show',['empleado'=>$empleado])}}">
                                    <button type="submit" class="btn btn-success "><i class="fa-solid fa-eye"></i></button>
                                </form>
                                <form action="{{route('empleados.edit',['empleado'=>$empleado])}}" method="get">
                                    <button type="submit" class="btn btn-primary"><i
                                    class="fa-solid fa-pencil"></i></button>
                                </form>

                                @if ($empleado->state == 1)
                                <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$empleado->id}}"><i
                                class="fa-solid fa-toggle-off fa-xl"></i></button>
                                @else
                                <button type="button" class="btn btn-info rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$empleado->id}}"><i
                                class="fa-solid fa-toggle-on fa-xl"></i></button>
                                @endif
                                <form action="{{route('empleados.forceDelete',[$empleado->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
        </div>
    <!-- Modal eliminar -->
    <div class="modal fade" id="confirmModal-{{$empleado->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                {!! $empleado->state == 1
                        ? '¿Seguro que quieres <strong>Deshabilitar</strong> este Empleado?'
                        : '¿Seguro que quieres <strong>Habilitar</strong> este Empleado?' !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form action="{{route('empleados.destroy',['empleado'=>$empleado->id])}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn {{$empleado->state == 1 ? 'btn-warning' : 'btn-info'}}">
                            {{$empleado->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
