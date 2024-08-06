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

    .btn-group {
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
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Campeonatos</li>
    </ol>
    <div class="mb-4">
        <h1 class="my-4 text-center">Campeonatos</h1>
        <a href="{{route('campeonatos.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nuevo Campeonato</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Tabla Campeonatos
        </div>
        <div class="card-body ">
            <table id="datatablesSimple" class="table table-striped justify-content-center">
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
                    @foreach ($campeonatos as $item)
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
                                    <span class="fw-bolder rounded p-1 bg-info text-black">Habilitado</span>
                                @else
                                    <span class="fw-bolder rounded p-1 bg-warning text-black">Deshabilitado</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="{{route('campeonatos.show', ['campeonato' => $item])}}">
                                        <button type="submit" class="btn btn-success rounded "><i
                                        class="fa-solid fa-eye"></i></button>
                                    </form>
                                    <form action="{{route('campeonatos.edit', ['campeonato' => $item])}}" method="get">
                                        <button type="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-pencil"></i></button>
                                    </form>
                                    @if ($item->state == 1)
                                        <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal-{{$item->id}}"><i class="fa-solid fa-toggle-off fa-xl"></i></button>
                                    @else
                                        <button type="button" class="btn btn-info rounded" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal-{{$item->id}}"><i class="fa-solid fa-toggle-on fa-xl"></i></button>
                                    @endif
                                    <form action="{{route('campeonatos.forceDelete', [$item->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                        class="fa-solid fa-trash"></i></button>
                                    </form>
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
                                        <form action="{{route('campeonatos.destroy', ['campeonato' => $item->id])}}"
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
