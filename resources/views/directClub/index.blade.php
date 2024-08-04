@extends('template')

@section('title', 'Directivos')

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
    }
</style>

<div class="container-fluid px-4">
    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Directivos Club</li>
    </ol>

    <h1 class="my-4 text-center">Directivos Club</h1>
    <div class="mb-4">
        <a href="{{route('directClubs.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nuevo Directivo</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Tabla de Directivos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped items-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Posición</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($directivos as $item)
                        <tr>
                            <td>
                                <p class="fw-semibold mb-1"> {{$item->name}} </p>
                            </td>
                            <td>
                                {{$item->email}}
                            </td>
                            <td>
                                {{$item->position}}
                            </td>
                            <td>
                                @if ($item->state == 1)
                                    <span class="fw-bolder rounded p-1 bg-success text-white d-block">Activo</span>
                                @else
                                    <span class="fw-bolder rounded p-1 bg-danger text-white d-block">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="{{route('directClubs.edit', ['directClub' => $item])}}" method="get">
                                        <button type="submit" class="btn btn-primary">Editar</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary rounded" data-bs-toggle="modal" data-bs-target="#verModal-{{$item->id}}">Ver</button>
                                    @if ($item->state == 1)
                                        <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal-{{$item->id}}">Deshabilitar</button>
                                    @else
                                        <button type="button" class="btn btn-info rounded" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal-{{$item->id}}">Restaurar</button>
                                    @endif
                                    <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{$item->id}}">Eliminar</button>

                                </div>
                            </td>
                        </tr>
                        <!-- Modal Ver-->
          <div class="modal fade" id="verModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Directivo Detalles</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Nombre:</span> {{$item->name}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Email:</span> {{$item->email}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Posición:</span> {{$item->position}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Telefono:</span> {{$item->phone}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Observación:</span> {{$item->observation}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Club:</span> {{$item->club->name}}</label>
                  </div>
                  <div class="row mb-3">
                    <label> <span class="fw-bolder">Campeonato:</span> {{$item->championship->name}}</label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
                        <!-- Desabilitar Modal -->
                        <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{$item->state == 1 ? 'Seguro que quieres deshabilitar este Directivo?' : 'Seguro que quieres restaurar este Directivo?'}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{route('directClubs.destroy', ['directClub' => $item->id])}}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn {{$item->state == 1 ? 'btn-danger' : 'btn-info'}}">
                                                {{$item->state == 1 ? 'Deshabilitar' : 'Restaurar'}}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Eliminar-->
                        <div class="modal fade" id="deleteModal-{{$item->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Seguro que quieres eliminar este Directivo?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <form action="{{route('directClubs.forceDelete', [$item->id])}}" method="POST">
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
