@extends('template')

@section('title', 'ParametroGeneral')

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
                        <h1 class="mt-4">Parametro General</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a> </li>
                            <li class="breadcrumb-item active">Parametro General</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Parametro General
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Estado Parametro</th>
                                            <th>Estado Civil</th>
                                            <th>Operadora Telefonica</th>
                                            <th>Tipo Contribuyente</th>
                                            <th>Tipo Parametro</th>
                                            <th>Tipo Sancion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gparametro as $gparametro )
                                            <tr>
                                                <td>
                                                    {{$gparametro->stateParameter->name}}
                                                </td>
                                                <td>
                                                    {{$gparametro->civilStatus->name}}
                                                </td>
                                                <td>
                                                    {{$gparametro->phoneOperator->name}}
                                                </td>
                                                <td>
                                                    {{$gparametro->taxpayerType->name}}
                                                </td>
                                                <td>
                                                    {{$gparametro->typeParameter->name}}
                                                </td>
                                                <td>
                                                    {{$gparametro->typeSanction->name}}
                                                </td>
                                            </tr>
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