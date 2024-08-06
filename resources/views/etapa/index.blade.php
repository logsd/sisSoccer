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

<div class="container-fluid px-4">

    <ol class="breadcrumb my-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Etapas</li>
    </ol>
    <h1 class="my-4 text-center">Etapas</h1>
    <div class="mb-4">
        <a href="{{route('etapas.create')}}">
            <button type="button" class="button"> <i class="fa-solid fa-plus"></i> Nueva Etapa</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Tabla Ligas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ejecutivo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etapas as $etapa)
                                    <tr>
                                        <td>
                                            {{$etapa->name}}
                                        </td>
                                        <td>
                                            {{$etapa->leagueExecutive->name}}
                                        </td>
                                        <td>
                                            @if ($etapa->state == 1)
                                                <span class="fw-bolder rounded p-1 bg-info text-black">Habilitado</span>
                                            @else
                                                <span class="fw-bolder rounded p-1 bg-warning text-black">Deshabilitado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-success rounded " data-bs-toggle="modal"
                                                    data-bs-target="#verModal-{{$etapa->id}}"><i class="fa-solid fa-eye"></i></button>
                                                <form action="{{route('etapas.edit', ['etapa' => $etapa])}}" method="get">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa-solid fa-pencil"></i></button>
                                                </form>
                                                @if ($etapa->state == 1)
                                                    <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal-{{$etapa->id}}"><i
                                                            class="fa-solid fa-toggle-off fa-xl rounded"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-info rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal-{{$etapa->id}}"><i
                                                            class="fa-solid fa-toggle-on fa-xl"></i></button>
                                                @endif
                                                <form action="{{route('etapas.forceDelete', [$etapa->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Ver-->
                                    <div class="modal fade" id="verModal-{{$etapa->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable"></div>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 "id="exampleModalLabel">Etapa</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                <div class="col-sm-12">
                                                        <div class="input-group ">
                                                                    <label class="fw-bolder mb-3"> <strong>Detalle</strong> </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-people-group"></i></span>
                                                            <input disabled type="text" class="form-control" value="Nombre:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$etapa->name}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-people-group"></i></span>
                                                            <input disabled type="text" class="form-control" value="Descripcion:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$etapa->description}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="input-group ">
                                                                    <label class="fw-bolder mb-3"> <strong>Ejecutivo</strong> </label>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"><i
                                                                    class="fa-solid fa-people-group"></i></span>
                                                            <input disabled type="text" class="form-control" value="Descripcion:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$etapa->leagueExecutive->name}}">

                                                                <div class="mt-2">
                                                            @if ($etapa->leagueExecutive->img_path != null)
                                                                <img src="{{ Storage::url('public/ejecutivos/' . $etapa->leagueExecutive->img_path)}}"
                                                                    alt="{{$etapa->leagueExecutive->name}}"
                                                                    class="img-fluid img-thumbnail border border-4 rounded">
                                                            @else
                                                                <img src="" alt="{{$etapa->leagueExecutive->name}}">
                                                            @endif
                                                        </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmModal-{{$etapa->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $etapa->state == 1
                        ? '¿Seguro que quieres <strong>Deshabilitar</strong> esta Etapa?'
                        : '¿Seguro que quieres <strong>Habilitar</strong> esta Etapa?' !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{route('etapas.destroy', ['etapa' => $etapa->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn {{$etapa->state == 1 ? 'btn-warning' : 'btn-info'}}">
                                                            {{$etapa->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
