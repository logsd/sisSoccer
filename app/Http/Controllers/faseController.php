<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Championship;
use App\Models\LeaguePhase;
use App\Models\LeagueGroups;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class faseController extends Controller implements HasMiddleware
{

    
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-fase|crear-fase|editar-fase|mostrar-fase|desabilizar-fase|eliminar-fase'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-fase'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-fase'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('mostrar-fase'),only:['show']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-fase'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-fase'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fases = LeaguePhase::with(['championship','leagueGroups'])->latest()->get();
        return view('fase.index',compact('fases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campeonatos = Championship::where('state', 1)->get();
        return view('fase.create',compact('campeonatos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaseRequest $request)
    {
        try {
            DB::beginTransaction();
            $fase = LeaguePhase::create([
                'name' => $request->name,
                'description' => $request->description,
                'championship_id' => $request->championship_id,
            ]);

            LeagueGroups::create([
                'name' => $request->nameGrupo,
                'description' => $request->descriptionGrupo,
                'league_phase_id' =>$fase->id
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('fases.index')->with('error', 'Hubo un problema al asignar la Fase y el Grupo');

        }
        return redirect()->route('fases.index')->with('success', 'Fase registrada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaguePhase $fase)
    {
        $grupos = LeagueGroups::where('state',1)->get();
        return view('fase.show',compact('fase','grupos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaguePhase $fase)
    {
        $grupo = LeagueGroups::where('league_phase_id', $fase->id)->first();
        $campeonatos = Championship::where('state',1)->get();
        return view('fase.edit',compact('fase','campeonatos','grupo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFaseRequest $request, LeaguePhase $fase)
    {
        try {
            DB::beginTransaction();
    
            $fase->update([
                'name' => $request->name,
                'description' => $request->description,
                'championship_id' => $request->championship_id,
            ]);
    
            $grupo = LeagueGroups::where('league_phase_id', $fase->id)->first();
            if ($grupo) {
                $grupo->update([
                    'name' => $request->nameGrupo,
                    'description' => $request->descriptionGrupo,
                ]);
            } else {
                LeagueGroups::create([
                    'name' => $request->nameGrupo,
                    'description' => $request->descriptionGrupo,
                    'league_phase_id' => $fase->id,
                ]);
            }

            DB::commit();
            return redirect()->route('fases.index')->with('success', 'Fase actualizada correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('fases.index')->with('error', 'Hubo un problema al actualizar la fase.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
    $message = '';
    $fase = LeaguePhase::find($id);

    if($fase) {
        try {
            DB::beginTransaction();

            // Cambiar el estado de la fase
            $newState = $fase->state == 1 ? 0 : 1;
            $fase->update([
                'state' => $newState
            ]);

            // Cambiar el estado de los grupos relacionados
            $fase->leagueGroups()->update(['state' => $newState]);

            DB::commit();

            // Configurar el mensaje adecuado
            if($newState == 0){
                $message = 'Fase y sus grupos Deshabilitados';
            } else {
                $message = 'Fase y sus grupos Habilitados';
            }

            return redirect()->route('fases.index')->with('success', $message);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('fases.index')->with('error', 'Hubo un problema al actualizar el estado de la Fase y sus Grupos');
        }
    }

    return redirect()->route('fases.index')->with('error', 'La Fase no fue encontrada');
    }

    public function forceDelete($id)
    {
        $fase = LeaguePhase::find($id);
        if ($fase) {
            $fase->delete();
            return redirect()->route('fases.index')->with('success', 'Fase eliminada definitivamente');
        }

        return redirect()->route('fases.index')->with('error', 'La Fase no fue encontrada');
    }
}
