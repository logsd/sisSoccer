<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeParameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTypeParameterRequest;

class TypeParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parametros = TypeParameter::latest()->get();
        return view('tparametro.index', ['parametros' => $parametros]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tparametro.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeParameterRequest $request )
    {
        // Para depuración
        // dd($request);

        try {
            DB::beginTransaction();
            $tparametro = TypeParameter::create($request->validated());
            $tparametro->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('tparametros.index')->with('success', 'Tipo de Parámetro registrado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeParameter $tparametro)
    {
        return view('tparametro.edit', compact('tparametro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTypeParameterRequest $request, TypeParameter $tparametro)
    {
        try {
            DB::beginTransaction();

            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $tparametro->update($validatedData);

            DB::commit();
            return redirect()->route('tparametros.index')->with('success', 'Tipo de Parámetro actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('tparametros.index')->with('error', 'Hubo un problema al actualizar el Tipo de Parámetro.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $tparametro = TypeParameter::find($id);

        if ($tparametro->state == 1) {
            $tparametro->update([
                'state' => 0
            ]);
            $message = 'Tipo de Parámetro Deshabilitado';
        } else {
            $tparametro->update([
                'state' => 1
            ]);
            $message = 'Tipo de Parámetro Habilitado';
        }
        return redirect()->route('tparametros.index')->with('success', $message);
    }


    public function forceDelete($id)
    {
        $tparametro = TypeParameter::find($id);
        if ($tparametro) {
            $tparametro->delete();
            return redirect()->route('tparametros.index')->with('success', 'Tipo de parámetro eliminado definitivamente');
        }

        return redirect()->route('tparametros.index')->with('error', 'El Tipo de Parámetro no fue encontrado');
    }
}
