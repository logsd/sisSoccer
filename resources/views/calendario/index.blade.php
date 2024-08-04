@extends('template')

@section('title', 'Calendario')

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
        <li class="breadcrumb-item active">Calendarios</li>
    </ol>

    <h1 class="my-4 text-center">Calendarios</h1>
    <div class="mb-4">
        <a href="{{route('calendarios.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nuevo Calendario</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Tabla de Calendario
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped items-center">
                <thead>
                    <tr>
                        <th>Estadio</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Local</th>
                        <th>Visitante</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calendarios as $item)
                                    <tr>
                                        <td>
                                            <p class="fw-semibold mb-1"> {{$item->stadium}} </p>
                                        </td>
                                        <td>
                                            <p class="fw-semibold mb-1"> {{\Carbon\Carbon::parse($item->date)->format('d-m-Y')}}</p>
                                        </td>
                                        <td>
                                            <p class="fw-semibold mb-1"> {{\Carbon\Carbon::parse($item->time)->format('H:i') . ' H'}}
                                            </p>
                                        </td>
                                        <td>
                                            {{$item->teamHome->name}}
                                        </td>
                                        <td>
                                            {{$item->teamAway->name}}
                                        </td>
                                        <td>
                                            @if ($item->status == 'scheduled')
                                                <span class="fw-bolder rounded p-1 bg-secondary text-white d-block mb-1">Programado</span>
                                            @elseif ($item->status == 'in_progress')
                                                <span class="fw-bolder rounded p-1 bg-success text-white d-block mb-1">En progreso</span>
                                            @elseif ($item->status == 'completed')
                                                <span class="fw-bolder rounded p-1 bg-primary text-white d-block mb-1">Completado</span>
                                            @else
                                                <span class="fw-bolder rounded p-1 bg-danger text-white d-block mb-1">Cancelado</span>
                                            @endif
                                            @if ($item->state == 1)
                                                <span class="fw-bolder rounded p-1 bg-info text-black d-block">Habilitado</span>
                                            @else
                                                <span class="fw-bolder rounded p-1 bg-warning text-black d-block">Deshabilitado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <form action="{{route('calendarios.show', ['calendario' => $item])}}">
                                                    <button type="submit" class="btn btn-success rounded"><i
                                                            class="fa-solid fa-eye"></i></button>
                                                </form>
                                                <form action="{{route('calendarios.edit', ['calendario' => $item])}}" method="get">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa-solid fa-pencil"></i></button>
                                                </form>



                                                @if ($item->state == 1)
                                                    <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal-{{$item->id}}">
                                                        <i class="fa-solid fa-toggle-off fa-xl"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-info rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal-{{$item->id}}">
                                                        <i class="fa-solid fa-toggle-on fa-xl"></i></button>
                                                @endif



                                                <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{$item->id}}"><i
                                                        class="fa-solid fa-trash"></i></button>

                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
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
                                                    {!! $item->state == 1
                                                            ? '¿Seguro que quieres <strong>Deshabilitar</strong> este Campeonato?'
                                                            : '¿Seguro que quieres <strong>Habilitar</strong> este Campeonato?' !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{route('calendarios.destroy', ['calendario' => $item->id])}}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn {{$item->state == 1 ? 'btn-warning' : 'btn-info'}}">
                                                            {{$item->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
                                                    Seguro que quieres eliminar este Partido?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{route('calendarios.forceDelete', [$item->id])}}" method="POST">
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