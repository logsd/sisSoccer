<?php

use App\Http\Controllers\departamentoController;
use App\Http\Controllers\ligaController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clubController;
use App\Http\Controllers\estadoController;
use App\Http\Controllers\telefonoController;
use App\Http\Controllers\contribuyenteController;
use App\Http\Controllers\ejecutivoController;
use App\Http\Controllers\reporteController;
use App\Http\Controllers\etapaController;
use App\Http\Controllers\dataClubController;
use App\Http\Controllers\campeonatoController;
use App\Http\Controllers\equipoController;
use App\Http\Controllers\periodoController;
use App\Http\Controllers\empleadoController;
use App\Http\Controllers\genTelefonoController;
use App\Http\Controllers\faseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
})->name('home');

Route::get('/panel', function () {
    return view('panel.index');
})->name('panel');

Route::resources([
    'ligas'=> ligaController::class,
    'departamentos' => departamentoController::class,
    'cargos'=> cargoController::class,
    'clubs'=> clubController::class,
    'categorias' => categoriaController::class,
    'estados' => estadoController::class,
    'telefonos' => telefonoController::class,
    'contribuyentes' => contribuyenteController::class,
    'ejecutivos' => ejecutivoController::class,
    'reportes' => reporteController::class,
    'etapas' => etapaController::class,
    'dataClubs' => dataClubController::class,
    'campeonatos' => campeonatoController::class,
    'equipos' => equipoController::class,
    'periodos' => periodoController::class,
    'empleados' => empleadoController::class,
    'genTelefonos' => genTelefonoController::class,
    'fases' => faseController::class,
]

);

Route::delete('/ligas/force-delete/{id}', [ligaController::class, 'forceDelete'
])->name('ligas.forceDelete');
Route::delete('/departamentos/force-delete/{id}', [departamentoController::class, 'forceDelete'
])->name('departamentos.forceDelete');
Route::delete('/cargos/force-delete/{id}', [cargoController::class, 'forceDelete'
])->name('cargos.forceDelete');
Route::delete('/clubs/force-delete/{id}', [clubController::class, 'forceDelete'
])->name('clubs.forceDelete');
Route::delete('/dataClubs/force-delete/{id}', [dataClubController::class, 'forceDelete'
])->name('dataClubs.forceDelete');
Route::delete('/categorias/force-delete/{id}', [categoriaController::class, 'forceDelete'
])->name('categorias.forceDelete');
Route::delete('/etapas/force-delete/{id}', [etapaController::class, 'forceDelete'
])->name('etapas.forceDelete');
Route::delete('/estados/force-delete/{id}', [estadoController::class, 'forceDelete'
])->name('estados.forceDelete');
Route::delete('/telefonos/force-delete/{id}', [telefonoController::class, 'forceDelete'
])->name('telefonos.forceDelete');
Route::delete('/contribuyentes/force-delete/{id}', [contribuyenteController::class, 'forceDelete'
])->name('contribuyentes.forceDelete');
Route::delete('/ejecutivos/force-delete/{id}', [ejecutivoController::class, 'forceDelete'
])->name('ejecutivos.forceDelete');
Route::delete('/reportes/force-delete/{id}', [reporteController::class, 'forceDelete'
])->name('reportes.forceDelete');
Route::delete('/campeonatos/force-delete/{id}', [campeonatoController::class, 'forceDelete'
])->name('campeonatos.forceDelete');
Route::delete('/equipos/force-delete/{id}', [equipoController::class, 'forceDelete'
])->name('equipos.forceDelete');
Route::delete('/periodos/force-delete/{id}', [periodoController::class, 'forceDelete'
])->name('periodos.forceDelete');
Route::delete('/genTelefonos/force-delete/{id}', [genTelefonoController::class, 'forceDelete'
])->name('genTelefonos.forceDelete');
Route::delete('/fases/force-delete/{id}', [faseController::class, 'forceDelete'
])->name('fases.forceDelete');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});
