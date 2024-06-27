@extends('template')

@section('title', 'Etapas')

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
                        <h1 class="mt-4">Etapas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Etapas</li>
                        </ol>
                        <div class="mb-4">
                        <a href="{{route('etapas.create')}}">
                            <button type="button" class="btn btn-primary">Añadir nueva Etapa</button>
                        </a>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Ligas
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Validez</th>
                                            <th>Ejecutivo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($etapas as $etapa )
                                            <tr>
                                                <td>
                                                    {{$etapa->name}}
                                                </td>
                                                <td>
                                                @if ($etapa->validity == 1)
                                                    <span class="fw-bolder rounded p-1 bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder rounded p-1 bg-danger text-white">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td>
                                                {{$etapa->leagueExecutive->name}}
                                                </td>
                                                <td>
                                                @if ($etapa->state == 1)
                                                    <span class="fw-bolder rounded p-1 bg-success text-white">Activo</span>
                                                    @else
                                                    <span class="fw-bolder rounded p-1 bg-danger text-white">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <form action="{{route('etapas.edit',['etapa'=>$etapa])}}" method="get">
                                                    <button type="submit" class="btn btn-warning">Editar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary " data-bs-toggle="modal" data-bs-target="#verModal-{{$etapa->id}}">Ver</button>
                                                    @if ($etapa->state == 1)
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$etapa->id}}">Eliminar</button>
                                                    @else
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$etapa->id}}">Restaurar</button>
                                                    @endif
                                                </div>
                                                </td>
                                            </tr>
<!-- Modal Ver-->
<div class="modal fade" id="verModal-{{$etapa->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <label> <span class="fw-bolder">Descripción:</span> {{$etapa->description}}</label>
        </div>
        <div class="row mb-3">
          <label class="fw-bolder mb-3" >Ejecutivo:</label>
          <label> <span class="fw-bolder">Nombre:</span> {{$etapa->leagueExecutive->name}}</label>
          <div>
            @if ($etapa->leagueExecutive->img_path != null)
                <img src="{{ Storage::url('public/ejecutivos/'. $etapa->leagueExecutive->img_path)}}" alt="{{$etapa->leagueExecutive->name}}" class="img-fluid img-thumbnail border border-4 rounded">
            @else
            <img src="" alt="{{$etapa->leagueExecutive->name}}">
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
<!-- Modal Acciones -->
<div class="modal fade" id="confirmModal-{{$etapa->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Seguro que quieres eliminar esta Etapa?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('etapas.destroy',['etapa'=>$etapa->id])}}" method="post">
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