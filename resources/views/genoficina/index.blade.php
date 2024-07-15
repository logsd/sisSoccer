@extends('template')

@section('title', 'OficinaGeneral')

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
                        <h1 class="mt-4">Oficina General</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Oficina General</li>
                        </ol>
                        <div class="mb-4">
                        <a href="{{route('genOficinas.create')}}">
                            <button type="button" class="btn btn-primary">Añadir nueva Oficina General</button>
                        </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla de Oficinas Generales
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Nombre Corto</th>
                                            <th>Direccion</th>
                                            <th>Reporte</th>
                                            <th>Comision</th>
                                            <th>Cargo</th>
                                            <th>Club</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($genOficinas as $genOficina )
                                            <tr>
                                                <td>
                                                    {{$genOficina->name}}
                                                </td>
                                                <td>
                                                    {{$genOficina->short_name}}
                                                </td>
                                                <td>
                                                    {{$genOficina->address}}
                                                </td>
                                                <td>
                                                    {{$genOficina->genReport->name?? ''}}
                                                </td>
                                                <td>
                                                    {{$genOficina->commissionLeague->name?? ''}}
                                                </td>
                                                <td>
                                                    {{$genOficina->genCharge->name?? ''}}
                                                </td>
                                                <td>
                                                    {{$genOficina->club->name?? ''}}
                                                </td>
                                                <td>
                                                    @if ($genOficina->state == 1)
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

                                                    @endif
                                                </td>
                                                <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{route('genOficinas.edit',['genOficina'=>$genOficina])}}" method="get">
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                    </form>
                                                    @if ($genOficina->state == 1)
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$genOficina->id}}">Desabilitar</button>
                                                    @else
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$genOficina->id}}">Restaurar</button>
                                                    @endif
                                                    <form action="{{route('genOficinas.forceDelete',[$genOficina->id])}}" method="POST">
                                                     @csrf
                                                         @method('DELETE')
                                                     <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>

                                                </div>
                                                </td>
                                            </tr>
<!-- Modal -->
<div class="modal fade" id="confirmModal-{{$genOficina->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{$genOficina->state ==1 ? 'Seguro que quieres eliminar esta oficina general?' : 'Seguro que quieres restaurar esta oficina general?'}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('genOficinas.destroy',['genOficina'=>$genOficina->id])}}" method="post">
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