<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\EditEquipoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\Category;
use App\Models\Championship;
use App\Models\CLub;
use Exception;

class equipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Team::with(['category','club','championship'])->latest()->get();
        return view('equipo.index',compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::where('state', 1)->get();
        $clubs = CLub::where('state',1)->get();
        return view('equipo.create',compact('categorias','clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipoRequest $request)
    {
        try {
            DB::beginTransaction();
            $equipo = Team::create($request->validated());   
            $equipo->save(); 
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('equipos.index')->with('success', 'Equipo registrado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $equipo)
    {
        return view('equipo.show',compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $equipo)
    {
        $categorias = Category::where('state', 1)->get();
        $clubs = CLub::where('state',1)->get();
        $campeonatos = Championship::where('state',1)->get();
        return view('equipo.edit',compact('equipo','categorias','campeonatos','clubs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditEquipoRequest $request, Team $equipo)
    {
        try {
            DB::beginTransaction();
    
            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $equipo->update($validatedData);
    
            DB::commit();
            return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('equipos.index')->with('error', 'Hubo un problema al actualizar el equipo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $equipo = Team::find($id);

        if($equipo->state == 1){
            $equipo->update([
                'state' => 0
            ]);
            $message = 'Equipo desabilitado';
        }else{
            $equipo->update([
                'state' => 1
            ]);
            $message = 'Equipo restaurado';
        }
        return redirect()->route('equipos.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $equipo = Team::find($id);
        if ($equipo) {
            $equipo->delete();
            return redirect()->route('equipos.index')->with('success', 'Equipo eliminado definitivamente');
        }

        return redirect()->route('equipos.index')->with('error', 'El Equipo no fue encontrado');
    }
}
