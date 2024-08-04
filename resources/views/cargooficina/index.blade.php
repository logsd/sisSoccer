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

<style>
    .button{
        background-color: #4EA93B;
        color: black;
        padding: 8px 15px 8px 15px;
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .button:hover{
        background-color:#337326;
        color:white;
    }

    .fa-plus{
        padding-right: 10px;
    }

    .card-header{
        background-color:#1A320F;
        color: white;
    }

    .btn{
        padding: 6px 15px 6px 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin: 0 5px 0 0;
    }

    .btn-group{
        justify-content: end;
        text-align: right;
    }

    .modal-header,
    .buttonc {
        background-color: #4EA93B;
        color: white;
        font-size: 110%;
    }

</style>

<div class="container-fluid px-4">

                        <ol class="breadcrumb my-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Cargos de Oficinas</li>
                        </ol>
                        <h1 class="my-4 text-center">Cargos de Oficinas</h1>
                        <div class="mb-4">
                        <a href="{{route('cargooficinas.create')}}">
                            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nuevo Cargo de Oficina</button>
                        </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
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
                            <span class="fw-bolder p-1 rounded bg-info text-black">Habilitado</span>
                            @else
                            <span class="fw-bolder p-1 rounded bg-warning text-black">Deshabilitado</span>
                            @endif
                        </td>
                        <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form action="{{route('cargooficinas.edit',['cargooficina'=>$cargooficina])}}" method="get">
                  <button type="submit" class="btn btn-primary rounded"><i
                  class="fa-solid fa-pencil"></i></button>
                </form>
                @if ($cargooficina->state == 1)
                <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cargooficina->id}}"><i class="fa-solid fa-toggle-off fa-xl"></i></button>
                @else
                <button type="button" class="btn btn-info rounded" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cargooficina->id}}"><i class="fa-solid fa-toggle-on fa-xl"></i></button>
                @endif
                <form action="{{route('cargooficinas.forceDelete',[$cargooficina->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger"><i
                  class="fa-solid fa-trash"></i></button>
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
      {!! $cargooficina->state == 1
        ? '¿Seguro que quieres <strong>deshabilitar</strong> este Cargo de Oficina?'
        : '¿Seguro que quieres <strong>habilitar</strong> este Cargo de Oficina?' !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{route('cargooficinas.destroy',['cargooficina'=>$cargooficina])}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn {{$cargooficina->state == 1 ? 'btn-warning' : 'btn-info'}}">
                {{$cargooficina->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
