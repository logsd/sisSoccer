<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstadoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StateParameter;
use Exception;


class estadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = StateParameter::latest()->get();
        return view('estado.index',['estados' => $estados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadoRequest $request)
    {
        try{
            DB::beginTransaction();
   
        // Validar y obtener los datos validados
        $validatedData = $request->validated();

        StateParameter::create($validatedData);
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('estados.index')->with('success', 'Estado registrado!');
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
    public function edit(StateParameter $estado)
    {
        return view('estado.edit',['estado'=>$estado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEstadoRequest $request, StateParameter $estado)
    {
        $estado->update($request->validated());
        return redirect()->route('estados.index')->with('success', 'Estado actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $estado = StateParameter::find($id);

        if($estado->state == 1){
            $estado->update([
                'state' => 0
            ]);
            $message = 'Estado Desabilitado';
        }else{
            $estado->update([
                'state' => 1
            ]);
            $message = 'Estado restaurado';
        }
        return redirect()->route('estados.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $estado = StateParameter::find($id);
        if ($estado) {
            $estado->delete();
            return redirect()->route('estados.index')->with('success', 'Estado eliminado definitivamente');
        }

        return redirect()->route('estados.index')->with('error', 'El Estado no fue encontrado');
    }
}
