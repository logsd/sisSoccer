@extends('template')

@section('title', 'Fases Campeonatos')

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

</style>

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center mb-4">Calendario</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Calendario</li>
    </ol>
    <div class="mb-4">
        <a href="{{route('calendarios.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Añadir nuevo Calendario</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Tabla Calendario
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
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
                    @foreach ($calendarios as $item )
                    <tr>
                        <td>
                        <p class="fw-semibold mb-1"> {{$item->stadium}} </p>
                        </td>
                        <td>
                            <p class="fw-semibold mb-1"> {{\Carbon\Carbon::parse($item->date)->format('d-m-Y')}}</p>
                        </td>
                        <td>
                            <p class="fw-semibold mb-1"> {{\Carbon\Carbon::parse($item->time)->format('H:i') . ' H'}}</p>
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
                            <span class="fw-bolder rounded p-1 bg-success text-white d-block">Activo</span>
                            @else
                            <span class="fw-bolder rounded p-1 bg-danger text-white d-block">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <form action="{{route('calendarios.edit',['calendario'=>$item])}}" method="get">
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                                <form action="{{route('calendarios.show',['calendario'=>$item])}}">
                                    <button type="submit" class="btn btn-secondary ">Ver</button>
                                </form>
                                @if ($item->state == 1)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Desabilitar</button>
                                @else
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Restaurar</button>
                                @endif
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$item->id}}">Eliminar</button>

                            </div>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{$item->state ==1 ? 'Seguro que quieres desabilitar este Partido?' : 'Seguro que quieres restaurar este Partido?'}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{route('calendarios.destroy',['calendario'=>$item->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Eliminar-->
                    <div class="modal fade" id="deleteModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Seguro que quieres eliminar este Partido?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{route('calendarios.forceDelete',[$item->id])}}" method="POST">
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
