@extends('template')

@section('title', 'Campeonatos')

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
    <h1 class="mt-4">Campeonatos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Campeonatos</li>
    </ol>
    <div class="mb-4">
        <a href="{{route('campeonatos.create')}}">
            <button type="button" class="btn btn-primary">Añadir nuevo Campeonato</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Campeonatos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Campeonato</th>
                        <th>Año</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campeonatos as $item )
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            <p class="fw-semibold mb-1"> {{$item->year}}</p>
                        </td>
                        <td>
                            @if ($item->category)
                            <span>{{ $item->category->name }}</span>
                            @else
                            <span class="fw-bolder rounded p-1 bg-danger text-white">No tiene</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->state == 1)
                            <span class="fw-bolder rounded p-1 bg-success text-white">Activo</span>
                            @else
                            <span class="fw-bolder rounded p-1 bg-danger text-white">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <form action="{{route('campeonatos.edit',['campeonato'=>$item])}}" method="get">
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                                <form action="{{route('campeonatos.show',['campeonato'=>$item])}}">
                                    <button type="submit" class="btn btn-secondary ">Ver</button>
                                </form>
                                @if ($item->state == 1)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Desabilitar</button>
                                @else
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}">Restaurar</button>
                                @endif
                                <form action="{{route('campeonatos.forceDelete',[$item->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
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
                                    {{$item->state ==1 ? 'Seguro que quieres eliminar esta Campeonato?' : 'Seguro que quieres restaurar esta Campeonato?'}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{route('campeonatos.destroy',['campeonato'=>$item->id])}}" method="post">
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