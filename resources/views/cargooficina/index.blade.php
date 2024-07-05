@extends('template')

@section('title', 'Cargo de Oficinas')

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
                        <h1 class="mt-4">Cargos de Oficinas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Cargos</li>
                        </ol>
                        <div class="mb-4">
                        <a href="{{route('cargooficinas.create')}}">
                            <button type="button" class="btn btn-primary">Añadir nuevo Cargo de Oficina</button>
                        </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Cargo de Oficinas
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Nombre Corto</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cargos as $cargooficina )
                                            <tr>
                                                <td>
                                                    {{$cargooficina->name}}
                                                </td>
                                                <td>
                                                    {{$cargooficina->short_name}}
                                                </td>
                                                <td>
                                                    {{$cargooficina->description}}
                                                </td>
                                                <td>
                            @if ($cargooficina->state == 1)
                            <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                            @else
                            <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>
                            @endif
                        </td>
                        <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form action="{{route('cargooficinas.edit',['cargooficina'=>$cargooficina])}}" method="get">
                  <button type="submit" class="btn btn-warning">Editar</button>
                </form>
                @if ($cargooficina->state == 1)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cargooficina->id}}">Desabilitar</button>
                @else
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cargooficina->id}}">Restaurar</button>
                @endif
                <form action="{{route('cargooficinas.forceDelete',[$cargooficina->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              </div>
            </td>

                                            </tr>
                                            <!-- Modal Ver-->
<div class="modal fade" id="verModal-{{$cargooficina->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comision de ligas Detalles</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <label> <span class="fw-bolder">Nombre:</span> {{$cargooficina->name}}</label>
        </div>
        <div class="row mb-3">
          <label> <span class="fw-bolder">Nombre Corto:</span> {{$cargooficina->short_name}}</label>
        </div>
        <div class="row mb-3">
          <label> <span class="fw-bolder">Descripción:</span> {{$cargooficina->description}}</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="confirmModal-{{$cargooficina->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{$cargooficina->state ==1 ? 'Seguro que quieres eliminar este Cargo de Oficinas?' : 'Seguro que quieres restaurar este Cargo de Oficinas?'}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('cargooficinas.destroy',['cargooficina'=>$cargooficina])}}" method="post">
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
