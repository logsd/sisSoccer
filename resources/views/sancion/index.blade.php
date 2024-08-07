@extends('template')

@section('title', 'Tipo de Sancion')

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
  <h1 class="mt-4">Tipos de Sanciones</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
    <li class="breadcrumb-item active">Sanción</li>
  </ol>
  <div class="mb-4">
    @can('crear-sancion')
    <a href="{{route('sancion.create')}}">
      <button type="button" class="btn btn-primary">Añadir nueva Sanción</button>
    </a>
    @endcan
  </div>
  <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-table me-1"></i>
      Sanciones
    </div>
    <div class="card-body">
      <table id="datatablesSimple" class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sancion as $sancion )
          <tr>
            <td>
              {{$sancion->name}}
            </td>
            <td>
              {{$sancion->description}}
            </td>
            <td>
              @if ($sancion->state == 1)
              <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
              @else
              <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

              @endif
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                @can('editar-sancion')
                <form action="{{route('sancion.edit',['sancion'=>$sancion])}}" method="get">
                  <button type="submit" class="btn btn-warning">Editar</button>
                </form>
                @endcan
                @can('desabilizar-sancion')
                @if ($sancion->state == 1)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$sancion->id}}">Desabilitar</button>
                @else
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$sancion->id}}">Restaurar</button>
                @endif
                @endcan
                @can('eliminar-sancion')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$sancion->id}}">Eliminar</button>
                @endcan
              </div>
            </td>

          </tr>
          <!-- Modal Ver-->
          <div class="modal fade" id="verModal-{{$sancion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Sanciones</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Nombre:</span> {{$sancion->name}}</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Eliminar -->
          <div class="modal fade" id="confirmModal-{{$sancion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  {{$sancion->state ==1 ? '¿Seguro que quieres eliminar esta Sancion?' : '¿Seguro que quieres restaurar esta Sancion?'}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <form action="{{route('sancion.destroy',['sancion'=>$sancion])}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Eliminar-->
          <div class="modal fade" id="deleteModal-{{$sancion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Seguro que quieres eliminar esta Sancion?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <form action="{{route('sanciones.forceDelete',[$sancion->id])}}" method="POST">
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