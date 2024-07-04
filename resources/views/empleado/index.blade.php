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
<div class="container-fluid px-4">
                        <h1 class="mt-4">Empleado</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Empleado</li>
                        </ol>
                        <div class="mb-4">
                        <a href="{{route('empleados.create')}}">
                            <button type="button" class="btn btn-primary">Añadir nuevo Empleado</button>
                        </a>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
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
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

                                                    @endif
                                                </td>
                                                <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{route('empleados.edit',['empleado'=>$empleado])}}" method="get">
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                    </form>
                                                    <form action="{{route('empleados.show',['empleado'=>$empleado])}}">
                                                    <button type="submit" class="btn btn-secondary ">Ver</button>
                                                    </form>

                                                    @if ($empleado->state == 1)
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$empleado->id}}">Eliminar</button>
                                                    @else
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$empleado->id}}">Restaurar</button>
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
        <button type="submit" class="btn btn-danger">Confirmar</button>
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