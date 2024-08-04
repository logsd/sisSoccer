@extends('template')

@section('title', 'Empleados')

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

    .btn {
        padding: 6px 15px 6px 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin: 0 5px 0 0;
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
</style>

<div class="container-fluid px-4">
                        <ol class="breadcrumb my-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
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
                                                    <span class="fw-bolder p-1 rounded bg-warning text-black">?Deshabilitado</span>

                                                    @endif
                                                </td>
                                                <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <form action="{{route('empleados.show',['empleado'=>$empleado])}}">
                                                    <button type="submit" class="btn btn-success rounded"><i class="fa-solid fa-eye"></i></button>
                                                    </form>
                                                    <form action="{{route('empleados.edit',['empleado'=>$empleado])}}" method="get">
                                                    <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-pencil"></i></button>
                                                    </form>

                                                    @if ($empleado->state == 1)
                                                    <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$empleado->id}}">Eliminar</button>
                                                    @else
                                                    <button type="button" class="btn btn-info rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$empleado->id}}">Restaurar</button>
                                                    @endif
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
        {{$empleado->state ==1 ? 'Seguro que quieres eliminar este Empleado?' : 'Seguro que quieres restaurar este Empleado?'}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('empleados.destroy',['empleado'=>$empleado->id])}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit"   class="btn {{$empleado->state == 1 ? 'btn-danger' : 'btn-info'}}">
                                                {{$empleado->state == 1 ? 'Deshabilitar' : 'Restaurar'}}
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
