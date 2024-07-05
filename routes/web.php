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
    'comisiondeligas' => ComisionLigaController::class,
    'cargooficinas' => CargoOficinaController::class,
    'tparametros' => TypeParameterController::class,
]

);

Route::delete('/comisiondeligas/force-delete/{id}', [ComisionLigaController::class, 'forceDelete'
])->name('comisiondeligas.forceDelete');

Route::delete('/cargooficinas/force-delete/{id}', [CargoOficinaController::class, 'forceDelete'
])->name('cargooficinas.forceDelete');

Route::delete('/tparametros/force-delete/{id}', [TypeParameterController::class, 'forceDelete'
])->name('tparametros.forceDelete');

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
