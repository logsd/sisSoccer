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
        <li class="breadcrumb-item active">Ligas</li>
    </ol>
    <h1 class="my-4 text-center">Ligas</h1>
    @can('crear-liga')
        <div class="mb-4">
            <a href="{{route('ligas.create')}}">
                <button type="button" class="button"><i class="fa-solid fa-plus"></i> Nueva Liga</button>
            </a>
        </div>
    @endcan
    <div class="card mb-4">
        <div class="card-header">

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
                    @foreach ($ligas as $liga)
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
                                            <p class="fw-semibold mb-1">
                                                {{\Carbon\Carbon::parse($liga->constitution_date)->format('d-m-Y')}}</p>
                                        </td>
                                        <td>
                                            @if ($liga->state == 1)
                                                <span class="fw-bolder p-1 rounded bg-info text-black">Habilitado</span>
                                            @else
                                                <span class="fw-bolder p-1 rounded bg-warning text-black">Deshabilitado</span>

                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-success rounded " data-bs-toggle="modal"
                                                    data-bs-target="#verModal-{{$liga->id}}"><i class="fa-solid fa-eye"></i></button>
                                                @can('editar-liga')
                                                    <form action="{{route('ligas.edit', ['liga' => $liga])}}" method="get">
                                                        <button type="submit" class="btn btn-primary rounded"><i
                                                                class="fa-solid fa-pencil"></i></button>
                                                    </form>
                                                @endcan

                                                @can('desabilizar-liga')
                                                    @if ($liga->state == 1)
                                                        <button type="button" class="btn btn-warning rounded" data-bs-toggle="modal"
                                                            data-bs-target="#confirmModal-{{$liga->id}}"><i
                                                                class="fa-solid fa-toggle-off fa-xl rounded"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-info rounded" data-bs-toggle="modal"
                                                            data-bs-target="#confirmModal-{{$liga->id}}"><i
                                                                class="fa-solid fa-toggle-on fa-xl"></i></button>
                                                    @endif
                                                @endcan
                                                @can('eliminar-liga')
                                                    <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal-{{$liga->id}}"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Ver-->
                                    <div class="modal fade" id="verModal-{{$liga->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de la Liga</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Nombre:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Nombre Corto:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->trade_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Nombre del Negocio:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->business_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Ruc:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->ruc}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Contribuyente:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->taxpayer->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Direccion:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->direction}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Email:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->email}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Fecha de elaboracion:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="  {{\Carbon\Carbon::parse($liga->constitution_date)->format('d-m-Y')}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Direccion Web:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->direction_web}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Slogan:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->slogan}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <div class="input-group">
                                                            <span class="input-group-text"><i class="fa-brands fa-dribbble"></i></span>
                                                            <input disabled type="text" class="form-control" value="Descripcion:">
                                                            <input disabled type="text" class="form-control  bg-white"
                                                                value="{{$liga->description}}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="fw-bolder mb-3">Imagen:</label>
                                                        <div>
                                                            @if ($liga->url_logo != null)
                                                                <img src="{{ Storage::url('public/ligas/' . $liga->url_logo)}}"
                                                                    alt="{{$liga->name}}"
                                                                    class="img-fluid img-thumbnail border border-4 rounded">
                                                            @else
                                                                <img src="" alt="{{$liga->name}}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="fw-bolder mb-3">Sello:</label>
                                                        <div>
                                                            @if ($liga->url_sello != null)
                                                                <img src="{{ Storage::url('public/ligas/' . $liga->url_sello)}}"
                                                                    alt="{{$liga->name}}"
                                                                    class="img-fluid img-thumbnail border border-4 rounded">
                                                            @else
                                                                <img src="" alt="{{$liga->name}}">
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
                                    <!-- Modal Eliminar-->
                                    <div class="modal fade" id="deleteModal-{{$liga->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Seguro que quieres eliminar esta Liga?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{route('ligas.forceDelete', [$liga->id])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Desabilitar -->
                                    <div class="modal fade" id="confirmModal-{{$liga->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de Confirmación</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $liga->state == 1
                        ? '¿Seguro que quieres <strong>Deshabilitar</strong> esta Liga?'
                        : '¿Seguro que quieres <strong>Habilitar</strong> esta Liga?' !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <form action="{{route('ligas.destroy', ['liga' => $liga->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn {{$liga->state == 1 ? 'btn-warning' : 'btn-info'}}">
                                                            {{$liga->state == 1 ? 'Deshabilitar' : 'Habilitar'}}
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
