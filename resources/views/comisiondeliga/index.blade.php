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

<div class="container-fluid px-4 ">
                        <ol class="breadcrumb mt-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Comisión de Ligas</li>
                        </ol>
                        <h1 class="text-center mb-4"> Comisión de Ligas</h1>
                        <div class="mb-4">
                        <a href="{{route('comisiondeligas.create')}}">
                            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nueva Comisión de Ligas</button>
                        </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
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
                            <span class="fw-bolder p-1 rounded bg-info text-black">Habilitado</span>
                            @else
                            <span class="fw-bolder p-1 rounded bg-warning text-black">Deshabilitado</span>

                            @endif
                        </td>
                        <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-success rounded" data-bs-toggle="modal" data-bs-target="#verModal-{{$comisiondeliga->id}}"><i
                        class="fa-solid fa-eye"></i></button>
                <form action="{{route('comisiondeligas.edit',['comisiondeliga'=>$comisiondeliga])}}" method="get">
                  <button type="submit" class="btn btn-primary"><i
                  class="fa-solid fa-pencil"></i></button>
                </form>
                @if ($comisiondeliga->state == 1)
                <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$comisiondeliga->id}}"><i class="fa-solid fa-toggle-off fa-xl"></i></button>
                @else
                <button type="button" class="btn btn-info rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$comisiondeliga->id}}"><i class="fa-solid fa-toggle-on fa-xl"></i></button>
                @endif
                <form action="{{route('comisiondeligas.forceDelete',[$comisiondeliga->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger"><i
                  class="fa-solid fa-trash"></i></button>
                </form>
              </div>
            </td>

                                            </tr>
                                            <!-- Modal Ver-->
                                            <div class="modal fade" id="verModal-{{$comisiondeliga->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-4 border-white">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comisión de Ligas Detalles</h1>
        <button type="button" class="buttonc shadow-none" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
      <div class="col-sm-12">
      <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-people-group"></i></span>
            <input disabled type="text" class="form-control" value="Nombre:">
            <input disabled type="text" class="form-control  bg-white" value="{{$comisiondeliga->name}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
            <input disabled type="text" class="form-control" value="Nombre Corto:">
            <input disabled type="text" class="form-control  bg-white" value="{{$comisiondeliga->short_name}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
            <input disabled type="text" class="form-control" value="Rol:">
            <input disabled type="text" class="form-control  bg-white" value="{{$comisiondeliga->role}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
            <input disabled type="text" class="form-control" value="Descripcion:">
            <input disabled type="text" class="form-control  bg-white" value="{{$comisiondeliga->description}}">
        </div>
    </div>


      </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="verModal-{{$comisiondeliga->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content ">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comisión de ligas Detalles</h1>
        <button type="button" class="buttonc shadow-none" data-bs-dismiss="modal" aria-label="Close">X</button>
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
  <div class="modal-dialog ">
    <div class="modal-content bg-white">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
        <button type="button" class="buttonc" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body bg-white">
      {!! $comisiondeliga->state == 1
                        ? '¿Seguro que quieres <strong>Deshabilitar</strong> esta Comisión de Liga?'
                        : '¿Seguro que quieres <strong>Habilitar</strong> esta Comisión de Liga?' !!}
                         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('comisiondeligas.destroy',['comisiondeliga'=>$comisiondeliga])}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit"
                class="btn {{$comisiondeliga->state == 1 ? 'btn-warning' : 'btn-info'}}">
                {{$comisiondeliga->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
