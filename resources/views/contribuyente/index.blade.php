@extends('template')

@section('title', 'Contribuyente')

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
                        <h1 class="mt-4">Contribuyentes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Contribuyentes</li>
                        </ol>
                        <div class="mb-4">
                        <a href="{{route('contribuyentes.create')}}">
                            <button type="button" class="btn btn-primary">Añadir nuevo Contribuyente</button>
                        </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Contribuyentes
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>A_Cont</th>
                                            <th>V.G</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contribuyentes as $contribuyente )
                                            <tr>
                                                <td>
                                                    {{$contribuyente->name}}
                                                </td>
                                                <td>
                                                    {{$contribuyente->description}}
                                                </td>
                                                <td>
                                                    @if ($contribuyente->a_cont == 1)
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Inactivo</span>

                                                    @endif
                                                </td>
                                                <td>
                                                @if ($contribuyente->vg == 1)
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Inactivo</span>

                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($contribuyente->state == 1)
                                                    <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

                                                    @endif
                                                </td>
                                                <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{route('contribuyentes.edit',['contribuyente'=>$contribuyente])}}" method="get">
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                    </form>
                                                    @if ($contribuyente->state == 1)
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$contribuyente->id}}">Eliminar</button>
                                                    @else
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$contribuyente->id}}">Restaurar</button>
                                                    @endif
                                                </div>
                                                </td>
                                            </tr>
<!-- Modal -->
<div class="modal fade" id="confirmModal-{{$contribuyente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{$contribuyente->state ==1 ? 'Seguro que quieres eliminar este Contribuyente?' : 'Seguro que quieres restaurar este Contribuyente?'}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('contribuyentes.destroy',['contribuyente'=>$contribuyente->id])}}" method="post">
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