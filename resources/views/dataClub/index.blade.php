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
    <h1 class="mt-4 text-center mb-2">Clubs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{route('home')}}">Inicio</a> </li>
        <li class="breadcrumb-item active">Clubs</li>
    </ol>
    <div class="mb-4">
        <a href="{{route('clubs.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Añadir nuevo Club</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
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
                    @foreach ($clubs as $club)
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
                                                <span class="fw-bolder p-1 rounded bg-info text-black">Habilitado</span>
                                            @else
                                                <span class="fw-bolder p-1 rounded bg-warning text-black">Deshabilitado</span>

                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                            <form action="{{route('clubs.show', ['club' => $club])}}">
                                        <button type="submit" class="btn btn-success rounded "><i
                                        class="fa-solid fa-eye"></i></button>
                                    </form>
                                                <form action="{{route('clubs.edit', ['club' => $club])}}" method="get">

                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa-solid fa-pencil"></i></button>
                                                </form>
                                                @if ($club->state == 1)
                                                    <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal-{{$club->id}}"><i
                                                            class="fa-solid fa-toggle-off fa-xl"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-info rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal-{{$club->id}}"><i
                                                            class="fa-solid fa-toggle-on fa-xl"></i></button>
                                                @endif
                                                <form action="{{route('clubs.forceDelete', [$club->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Ver-->
                                    <div class="modal fade" id="verModal-{{$club->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Club Detalles</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-people-group"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->name}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->trade_name}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->reason_social}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->ruc}}">
                                                    </div>


                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->direction}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->email}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->date_constion}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->direction_web}}">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="fa-solid fa-pencil"></i></span>
                                                        <input disabled type="text" class="form-control" value="Nombre:">
                                                        <input disabled type="text" class="form-control  bg-white"
                                                            value="{{$club->slogan}}">
                                                    </div>


                                                    <div class="row mb-3">
                                                        <label class="fw-bolder mb-3">Imagen:</label>
                                                        <div>
                                                            @if ($club->logo != null)
                                                                <img src="{{ Storage::url('public/clubs/' . $club->logo)}}"
                                                                    alt="{{$club->name}}"
                                                                    class="img-fluid img-thumbnail border border-4 rounded">
                                                            @else
                                                                <img src="" alt="{{$club->name}}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Eliminar -->
                                    <div class="modal fade" id="confirmModal-{{$club->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $club->state == 1
                        ? '¿Seguro que quieres <strong>Deshabilitar</strong> este Club?'
                        : '¿Seguro que quieres <strong>Habilitar</strong> este Club?' !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{route('clubs.destroy', ['club' => $club->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn {{$club->state == 1 ? 'btn-warning' : 'btn-info'}}">
                                                            {{$club->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
    <h1 class="mt-4 mb-4">Telefonos Clubs</h1>
    <div class="mb-4">
        <a href="{{route('dataClubs.create')}}">
            <button type="button" class="button"><i class="fa-solid fa-plus"></i>Nuevo Teléfono de Club</button>
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            Tabla Teléfonos Clubs
        </div>
        <div class="card-body">
            <table id="datatablesSimple1" class="table table-striped">
                <thead>
                    <tr>
                        <th>Teléfono</th>
                        <th>Operadora</th>
                        <th>Descripción</th>
                        <th>Club</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataClubs as $dataClub)
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
                                                <span class="fw-bolder p-1 rounded bg-info text-black">Habilitado</span>
                                            @else
                                                <span class="fw-bolder p-1 rounded bg-warning text-black">Deshabilitado</span>

                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <form action="{{route('dataClubs.edit', ['dataClub' => $dataClub])}}" method="get">
                                                    <button type="submit" class="btn btn-primary rounded"><i
                                                            class="fa-solid fa-pencil"></i></button>
                                                </form>
                                                @if ($dataClub->state == 1)
                                                    <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal1-{{$dataClub->id}}"><i
                                                            class="fa-solid fa-toggle-off fa-xl"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-info rounded" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal1-{{$dataClub->id}}"><i
                                                            class="fa-solid fa-toggle-on fa-xl"></i></button>
                                                @endif
                                                <form action="{{route('dataClubs.forceDelete', [$dataClub->id])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Eliminar -->
                                    <div class="modal fade" id="confirmModal1-{{$dataClub->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $dataClub->state == 1
                        ? '¿Seguro que quieres <strong>Deshabilitar</strong> este Teléfono del Club?'
                        : '¿Seguro que quieres <strong>Habilitar</strong> esta Teléfono del Club?' !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{route('dataClubs.destroy', ['dataClub' => $dataClub->id])}}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn {{$dataClub->state == 1 ? 'btn-warning' : 'btn-info'}}">
                                                            {{$dataClub->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
