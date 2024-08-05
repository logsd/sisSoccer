<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCalendarioRequest;
use App\Http\Requests\EditCalendarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Calendar;
use App\Models\Championship;
use App\Models\Team;
use App\Models\LeaguePhase;
use Exception;

class calendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calendarios = Calendar::with(['teamHome','teamAway','championship','leaguePhase.championship'])->latest()->get();
        return view('calendario.index',compact('calendarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Team::where('state',1)->get();
        $campeonatos = Championship::where('state',1)->get();
        $fases = LeaguePhase::where('state',1)->get();
        return view('calendario.create',compact('equipos','campeonatos','fases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarioRequest $request)
    {
        try {
            DB::beginTransaction();
            $calendario = Calendar::create($request->validated());   
            $calendario->save(); 
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('calendarios.index')->with('success', '¡Partido registrado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Calendar $calendario)
    {
        return view('calendario.show',compact('calendario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendario)
    {
        $equipos = Team::where('state',1)->get();
        $campeonatos = Championship::where('state',1)->get();
        $fases = LeaguePhase::where('state',1)->get();
        return view('calendario.edit',compact('calendario','equipos','campeonatos','fases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCalendarioRequest $request, Calendar $calendario)
    {
        try {
            DB::beginTransaction();
    
            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $calendario->update($validatedData);
    
            DB::commit();
            return redirect()->route('calendarios.index')->with('success', '¡Partido actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('calendarios.index')->with('error', 'Hubo un problema al actualizar el partido.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $calendario = Calendar::find($id);

        if($calendario->state == 1){
            $calendario->update([
                'state' => 0
            ]);
            $message = 'Calendario Habilitado';
        }else{
            $calendario->update([
                'state' => 1
            ]);
            $message = 'Calendario Habilitado';
        }
        return redirect()->route('calendarios.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $calendario = Calendar::find($id);
        if ($calendario) {
            $calendario->delete();
            return redirect()->route('calendarios.index')->with('success', 'Partido eliminado definitivamente');
        }

        return redirect()->route('calendarios.index')->with('error', 'El Partido no fue encontrado');
    }
}
