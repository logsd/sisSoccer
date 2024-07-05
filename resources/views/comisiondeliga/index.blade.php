@extends('template')

@section('title', 'Comision de Ligas')

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
                        <h1 class="mt-4">Comision de Ligas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Clubs</li>
                        </ol>
                        <div class="mb-4">
                        <a href="{{route('comisiondeligas.create')}}">
                            <button type="button" class="btn btn-primary">Añadir nueva Comision de Ligas</button>
                        </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Comisiones
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Nombre Corto</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comisiones as $comisiondeliga )
                                            <tr>
                                                <td>
                                                    {{$comisiondeliga->name}}
                                                </td>
                                                <td>
                                                    {{$comisiondeliga->short_name}}
                                                </td>
                                                <td>
                                                    {{$comisiondeliga->role}}
                                                </td>
                                                <td>
                            @if ($comisiondeliga->state == 1)
                            <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                            @else
                            <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

                            @endif
                        </td>
                        <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form action="{{route('comisiondeligas.edit',['comisiondeliga'=>$comisiondeliga])}}" method="get">
                  <button type="submit" class="btn btn-warning">Editar</button>
                </form>
                <button type="button" class="btn btn-secondary " data-bs-toggle="modal" data-bs-target="#verModal-{{$comisiondeliga->id}}">Ver</button>
                @if ($comisiondeliga->state == 1)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$comisiondeliga->id}}">Desabilitar</button>
                @else
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$comisiondeliga->id}}">Restaurar</button>
                @endif
                <form action="{{route('comisiondeligas.forceDelete',[$comisiondeliga->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              </div>
            </td>

                                            </tr>
                                            <!-- Modal Ver-->
<div class="modal fade" id="verModal-{{$comisiondeliga->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comision de ligas Detalles</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <label> <span class="fw-bolder">Nombre:</span> {{$comisiondeliga->name}}</label>
        </div>
        <div class="row mb-3">
          <label> <span class="fw-bolder">Nombre Corto:</span> {{$comisiondeliga->short_name}}</label>
        </div>
        <div class="row mb-3">
          <label> <span class="fw-bolder">Rol:</span> {{$comisiondeliga->role}}</label>
        </div>
        <div class="row mb-3">
          <label> <span class="fw-bolder">Descripción:</span> {{$comisiondeliga->description}}</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="confirmModal-{{$comisiondeliga->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{$comisiondeliga->state ==1 ? 'Seguro que quieres eliminar esta Comision de Liga?' : 'Seguro que quieres restaurar esta Comision de Liga?'}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('comisiondeligas.destroy',['comisiondeliga'=>$comisiondeliga])}}" method="post">
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
