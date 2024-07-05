<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GenCharge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCargoOficina;

class CargoOficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = GenCharge::latest()->get();
        return view('cargooficina.index',['cargos' => $cargos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cargooficina.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargoOficina $request)
    {
        try {
            DB::beginTransaction();
            $cargooficina = GenCharge::create($request->validated());
            $cargooficina->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('cargooficinas.index')->with('success', 'Equipo registrado!');
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
    public function edit(GenCharge $cargooficina)
    {
        return view('cargooficina.edit',['cargooficina'=>$cargooficina]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCargoOficina $request, GenCharge $cargooficina)
    {
        try {
            DB::beginTransaction();

            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $cargooficina->update($validatedData);

            DB::commit();
            return redirect()->route('cargooficinas.index')->with('success', 'Cargo de Oficina actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('cargooficinas.index')->with('error', 'Hubo un problema al actualizar el Cargo de Oficina.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $cargooficina = GenCharge::find($id);

        if ($cargooficina->state == 1) {
            $cargooficina->update([
                'state' => 0
            ]);
            $message = 'Cargo de Oficina eliminada';
        } else {
            $cargooficina->update([
                'state' => 1
            ]);
            $message = 'Cargo de Oficina restaurada';
        }
        return redirect()->route('cargooficinas.index')->with('success', $message);
    }


    public function forceDelete($id)
    {
        $cargooficina = GenCharge::find($id);
        if ($cargooficina) {
            $cargooficina->delete();
            return redirect()->route('cargooficinas.index')->with('success', 'Cargo de Oficina eliminado definitivamente');
        }

        return redirect()->route('cargooficinas.index')->with('error', 'El Cargo de Oficina no fue encontrado');
    }

}