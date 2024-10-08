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
use App\Http\Controllers\ComisionLigaController;
use App\Http\Controllers\CargoOficinaController;
use App\Http\Controllers\TypeParameterController;
use App\Http\Controllers\dataClubController;
use App\Http\Controllers\campeonatoController;
use App\Http\Controllers\equipoController;
use App\Http\Controllers\periodoController;
use App\Http\Controllers\empleadoController;
use App\Http\Controllers\genTelefonoController;
use App\Http\Controllers\faseController;
use App\Http\Controllers\calendarioController;
use App\Http\Controllers\sancionController;
use App\Http\Controllers\genEstadoController;
use App\Http\Controllers\genOficinaController;
use App\Http\Controllers\jugadorController;
use App\Http\Controllers\directClubController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logOutController;
use App\Http\Controllers\userController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\perfilController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
   // return view('template');
//})->name('home');

Route::get('/home',[homeController::class,'index'])->name('home');

Route::get('/dashboard', function () {
    return view('panel.index');
})->name('dashboard');

Route::get('/jugadores/carnetsPDF', [jugadorController::class, 'carnet'])->name('jugadores.carnet');

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
    'comisiondeligas' => ComisionLigaController::class,
    'cargooficinas' => CargoOficinaController::class,
    'tparametros' => TypeParameterController::class,
    'dataClubs' => dataClubController::class,
    'campeonatos' => campeonatoController::class,
    'equipos' => equipoController::class,
    'periodos' => periodoController::class,
    'empleados' => empleadoController::class,
    'genTelefonos' => genTelefonoController::class,
    'fases' => faseController::class,
    'calendarios' => calendarioController::class,
    'sancion' => sancionController::class,
    'genEstados' => genEstadoController::class,
    'genOficinas' => genOficinaController::class,
    'jugadores' => jugadorController::class,
    'directClubs' => directClubController::class,
    'users' => userController::class,
    'roles' => roleController::class,
    'profile' => perfilController::class,
]

);


Route::delete('/comisiondeligas/force-delete/{id}', [ComisionLigaController::class, 'forceDelete'
])->name('comisiondeligas.forceDelete');

Route::delete('/cargooficinas/force-delete/{id}', [CargoOficinaController::class, 'forceDelete'
])->name('cargooficinas.forceDelete');

Route::delete('/tparametros/force-delete/{id}', [TypeParameterController::class, 'forceDelete'
])->name('tparametros.forceDelete');
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
Route::delete('/calendarios/force-delete/{id}', [calendarioController::class, 'forceDelete'
])->name('calendarios.forceDelete');
Route::delete('/sanciones/force-delete/{id}', [sancionController::class, 'forceDelete'
])->name('sanciones.forceDelete');
Route::delete('/genEstados/force-delete/{id}', [genEstadoController::class, 'forceDelete'
])->name('genEstados.forceDelete');
Route::delete('/genOficinas/force-delete/{id}', [genOficinaController::class, 'forceDelete'
])->name('genOficinas.forceDelete');
Route::delete('/jugadores/force-delete/{id}', [jugadorController::class, 'forceDelete'
])->name('jugadores.forceDelete');
Route::delete('/directClubs/force-delete/{id}', [directClubController::class, 'forceDelete'
])->name('directClubs.forceDelete');
Route::delete('/empleados/force-delete/{id}', [empleadoController::class, 'forceDelete'
])->name('empleados.forceDelete');



Route::get('/login', [loginController::class, 'index']
)->name('login');

Route::post('/login', [loginController::class, 'login']
);

Route::get('/logout', [logOutController::class, 'logout']
)->name('logout');

Route::get('/401', function () {
    return view('pages.401');
});

Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/500', function () {
    return view('pages.500');
});

Route::get('/', function () {
    return redirect()->route('login');
});