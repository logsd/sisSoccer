<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\CommissionLeague;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreComisionLigaRequest;

class ComisionLigaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comisiones = CommissionLeague::latest()->get();
        return view('comisiondeliga.index', ['comisiones' => $comisiones]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comisiondeliga.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComisionLigaRequest $request )
    {
        // Para depuración
        // dd($request);

        try {
            DB::beginTransaction();
            $comisionliga = CommissionLeague::create($request->validated());
            $comisionliga->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('comisiondeligas.index')->with('success', 'Equipo registrado!');
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
    public function edit( CommissionLeague $comisiondeliga)
    {
        return view('comisiondeliga.edit', compact('comisiondeliga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreComisionLigaRequest $request, CommissionLeague $comisiondeliga)
    {
        try {
            DB::beginTransaction();

            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $comisiondeliga->update($validatedData);

            DB::commit();
            return redirect()->route('comisiondeligas.index')->with('success', 'Equipo actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('comisiondeligas.index')->with('error', 'Hubo un problema al actualizar el equipo.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $comisionliga = CommissionLeague::find($id);

        if ($comisionliga->state == 1) {
            $comisionliga->update([
                'state' => 0
            ]);
            $message = 'Comisión de Liga eliminada';
        } else {
            $comisionliga->update([
                'state' => 1
            ]);
            $message = 'Comisión de Liga restaurada';
        }
        return redirect()->route('comisiondeligas.index')->with('success', $message);
    }


    public function forceDelete($id)
    {
        $comisionliga = CommissionLeague::find($id);
        if ($comisionliga) {
            $comisionliga->delete();
            return redirect()->route('comisiondeligas.index')->with('success', 'Equipo eliminado definitivamente');
        }

        return redirect()->route('comisiondeligas.index')->with('error', 'El Equipo no fue encontrado');
    }
}
