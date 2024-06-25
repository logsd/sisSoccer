<?php

use App\Http\Controllers\departamentoController;
use App\Http\Controllers\ligaController;
use App\Http\Controllers\cargoController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\clubController;
use App\Http\Controllers\estadoController;
use App\Http\Controllers\telefonoController;
use App\Http\Controllers\contribuyenteController;
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
]

);

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
