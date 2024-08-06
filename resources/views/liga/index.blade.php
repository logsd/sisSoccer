@extends('template')

@section('title', 'Liga')

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
  <h1 class="mt-4">Ligas</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
    <li class="breadcrumb-item active">Ligas</li>
  </ol>
  <div class="mb-4">
    <a href="{{route('ligas.create')}}">
      <button type="button" class="btn btn-primary">Añadir nueva Liga</button>
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
            <th>Ruc</th>
            <th>Email</th>
            <th>Fecha Creación</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($ligas as $liga )
          <tr>
            <td>
              {{$liga->name}}
            </td>
            <td>
              {{$liga->ruc}}
            </td>
            <td>
              {{$liga->email}}
            </td>
            <td>
              <p class="fw-semibold mb-1"> {{\Carbon\Carbon::parse($liga->constitution_date)->format('d-m-Y')}}</p>
            </td>
            <td>
              @if ($liga->state == 1)
              <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
              @else
              <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

              @endif
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form action="{{route('ligas.edit',['liga'=>$liga])}}" method="get">
                  <button type="submit" class="btn btn-warning">Editar</button>
                </form>
                <button type="button" class="btn btn-secondary " data-bs-toggle="modal" data-bs-target="#verModal-{{$liga->id}}">Ver</button>
                @if ($liga->state == 1)
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$liga->id}}">Desabilitar</button>
                @else
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$liga->id}}">Restaurar</button>
                @endif
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$liga->id}}">Eliminar</button>
              </div>
            </td>
          </tr>
          <!-- Modal Ver-->
          <div class="modal fade" id="verModal-{{$liga->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Liga Detalles</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Nombre:</span> {{$liga->name}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Nombre Corto:</span> {{$liga->trade_name}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Nombre del negocio:</span> {{$liga->business_name}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Ruc:</span> {{$liga->ruc}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Contribuyente:</span> {{$liga->taxpayer->name}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Dirección:</span> {{$liga->direction}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Email:</span> {{$liga->email}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Fecha Creado:</span> {{\Carbon\Carbon::parse($liga->constitution_date)->format('d-m-Y')}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Direccion web:</span> {{$liga->direction_web}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Slogan:</span> {{$liga->slogan}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Descripción:</span> {{$liga->description}}</label>
                  </div>
                  <div class="row mb-3">
                    <label class="fw-bolder mb-3">Imagen:</label>
                    <div>
                      @if ($liga->url_logo != null)
                      <img src="{{ Storage::url('public/ligas/'. $liga->url_logo)}}" alt="{{$liga->name}}" class="img-fluid img-thumbnail border border-4 rounded">
                      @else
                      <img src="" alt="{{$liga->name}}">
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="fw-bolder mb-3">Sello:</label>
                    <div>
                      @if ($liga->url_sello != null)
                      <img src="{{ Storage::url('public/ligas/'. $liga->url_sello)}}" alt="{{$liga->name}}" class="img-fluid img-thumbnail border border-4 rounded">
                      @else
                      <img src="" alt="{{$liga->name}}">
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
          <!-- Modal Eliminar-->
          <div class="modal fade" id="deleteModal-{{$liga->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Seguro que quieres eliminar esta Liga?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <form action="{{route('ligas.forceDelete',[$liga->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Desabilitar -->
          <div class="modal fade" id="confirmModal-{{$liga->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  {{$liga->state ==1 ? 'Seguro que quieres desabilitar esta Liga?' : 'Seguro que quieres restaurar esta liga?'}}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <form action="{{route('ligas.destroy',['liga'=>$liga->id])}}" method="post">
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