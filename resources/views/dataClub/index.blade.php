@extends('template')

@section('title', 'Data Club')

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
  <h1 class="mt-4">Clubs</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
    <li class="breadcrumb-item active">Clubs</li>
  </ol>
  <div class="mb-4">
    <a href="{{route('clubs.create')}}">
      <button type="button" class="btn btn-primary">Añadir nuevo Club</button>
    </a>
  </div>
  <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-table me-1"></i>
      Tabla Clubs
    </div>
    <div class="card-body">
      <table id="datatablesSimple" class="table table-striped">
        <thead>
          <tr>
            <th>Club</th>
            <th>Ruc</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($clubs as $club )
          <tr>
            <td>
              {{$club->name}}
            </td>
            <td>
              {{$club->ruc}}
            </td>
            <td>
              {{$club->email}}
            </td>
            <td>
              @if ($club->state == 1)
              <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
              @else
              <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

              @endif
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form action="{{route('clubs.edit',['club'=>$club])}}" method="get">
                  <button type="submit" class="btn btn-warning">Editar</button>
                </form>
                <button type="button" class="btn btn-secondary " data-bs-toggle="modal" data-bs-target="#verModal-{{$club->id}}">Ver</button>
                @if ($club->state == 1)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$club->id}}">Desabilitar</button>
                @else
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$club->id}}">Restaurar</button>
                @endif
                <form action="{{route('clubs.forceDelete',[$club->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              </div>
            </td>
          </tr>
          <!-- Modal Ver-->
          <div class="modal fade" id="verModal-{{$club->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Club Detalles</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Nombre:</span> {{$club->name}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Descripción:</span> {{$club->description}}</label>
                  </div>
                  <div class="row mb-3">
                    <label class="fw-bolder mb-3">Imagen:</label>
                    <div>
                      @if ($club->logo != null)
                      <img src="{{ Storage::url('public/clubs/'. $club->logo)}}" alt="{{$club->name}}" class="img-fluid img-thumbnail border border-4 rounded">
                      @else
                      <img src="" alt="{{$club->name}}">
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
          <!-- Modal Eliminar -->
          <div class="modal fade" id="confirmModal-{{$club->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  {{$club->state ==1 ? 'Seguro que quieres desabilitar este Club?' : 'Seguro que quieres restaurar este Club?'}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <form action="{{route('clubs.destroy',['club'=>$club->id])}}" method="post">
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
  <h1 class="mt-4">Telefonos Clubs</h1>
  <div class="mb-4">
    <a href="{{route('dataClubs.create')}}">
      <button type="button" class="btn btn-primary">Añadir nuevo Telefono al Club</button>
    </a>
  </div>
  <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-table me-1"></i>
      Tabla Telefonos Clubs
    </div>
    <div class="card-body">
      <table id="datatablesSimple1" class="table table-striped">
        <thead>
          <tr>
            <th>Telefono</th>
            <th>Operadora</th>
            <th>Descripción</th>
            <th>Club</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataClubs as $dataClub )
          <tr>
            <td>
              {{$dataClub->phone}}
            </td>
            <td>
              {{$dataClub->operator}}
            </td>
            <td>
              {{$dataClub->description}}
            </td>
            <td>
              {{$dataClub->club->name}}
            </td>
            <td>
              @if ($dataClub->state == 1)
              <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
              @else
              <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

              @endif
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form action="{{route('dataClubs.edit',['dataClub'=>$dataClub])}}" method="get">
                  <button type="submit" class="btn btn-warning">Editar</button>
                </form>
                @if ($dataClub->state == 1)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$dataClub->id}}">Desabilitar</button>
                @else
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$dataClub->id}}">Restaurar</button>
                @endif
                <form action="{{route('dataClubs.forceDelete',[$dataClub->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
              </div>
            </td>
          </tr>

          <!-- Modal Eliminar -->
          <div class="modal fade" id="confirmModal-{{$dataClub->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  {{$dataClub->state ==1 ? 'Seguro que quieres desabilitar este Telefono del Club?' : 'Seguro que quieres restaurar este Telefono del Club?'}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <form action="{{route('dataClubs.destroy',['dataClub'=>$dataClub->id])}}" method="post">
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
  <!--Termina Telefono-->
  <!---->
</div>
</div>
</div>
<br>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

@endpush