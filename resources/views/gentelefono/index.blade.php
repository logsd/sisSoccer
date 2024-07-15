@extends('template')

@section('title', 'TelefonoGeneral')

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
<div class="container-fluid px-4">
                        <h1 class="mt-4">Telefono General</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Telefono General</li>
                        </ol>
                        <div class="mb-4">
                        <a href="{{route('genTelefonos.create')}}">
                            <button type="button" class="btn btn-primary">Añadir nuevo Telefono</button>
                        </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla telefonos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Descripción</th>
                                            <th>Ejecutivo</th>
                                            <th>Empleado</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($genTelefonos as $genTelefono )
                                            <tr>
                                                <td>
                                                    {{$genTelefono->number}}
                                                </td>
                                                <td>
                                                    {{$genTelefono->description}}
                                                </td>
                                                <td>
                                                    {{$genTelefono->leagueExecutive->name?? ''}}
                                                </td>
                                                <td>
                                                    {{$genTelefono->employee->name?? ''}}
                                                </td>
                                                <td>
                                                    @if ($genTelefono->state == 1)
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

                                                    @endif
                                                </td>
                                                <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{route('genTelefonos.edit',['genTelefono'=>$genTelefono])}}" method="get">
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                    </form>
                                                    @if ($genTelefono->state == 1)
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$genTelefono->id}}">Desabilitar</button>
                                                    @else
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$genTelefono->id}}">Restaurar</button>
                                                    @endif
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$genTelefono->id}}">Eliminar</button>

                                                </div>
                                                </td>
                                            </tr>
<!-- Modal -->
<div class="modal fade" id="confirmModal-{{$genTelefono->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{$genTelefono->state ==1 ? 'Seguro que quieres eliminar este Telefono?' : 'Seguro que quieres restaurar este Telefono?'}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('genTelefonos.destroy',['genTelefono'=>$genTelefono->id])}}" method="post">
            @method('DELETE')
            @csrf
        <button type="submit" class="btn btn-danger">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Eliminar-->
<div class="modal fade" id="deleteModal-{{$genTelefono->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Seguro que quieres eliminar este Telefono?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{route('genTelefonos.forceDelete',[$genTelefono->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
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