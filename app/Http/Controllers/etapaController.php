<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtapaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GenState;
use App\Models\LeagueExecutive;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class etapaController extends Controller implements HasMiddleware
{

        
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-etapa|crear-etapa|editar-etapa|desabilizar-etapa|eliminar-etapa'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-etapa'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-etapa'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-etapa'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-etapa'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etapas = GenState::with(['leagueExecutive'])->latest()->get();

        return view('etapa.index', compact('etapas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ejecutivos = LeagueExecutive::where('state', 1)->get();
        return view('etapa.create',compact('ejecutivos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtapaRequest $request)
    {
        try {
            DB::beginTransaction();
            $etapa = new GenState();
            $etapa->fill([
                'name' => $request->name,
                'description' => $request->description,
                'league_executive_id' => $request->league_executive_id
            ]);

            $etapa->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('etapas.index')->with('success', 'Etapa registrada!');

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
    public function edit(GenState $etapa)
    {
        $ejecutivos = LeagueExecutive::where('state', 1)->get();
        return view('etapa.edit',compact('etapa','ejecutivos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEtapaRequest $request, GenState $etapa)
    {
        try{
            DB::beginTransaction();

            $etapa->fill([
                'name' => $request->name,
                'description' => $request->description,
                'league_executive_id' => $request->league_executive_id
            ]);

            $etapa->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('etapas.index')->with('success', 'Etapa actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $message = '';
        $etapa = GenState::find($id);

        if ($etapa->state == 1) {
            $etapa->update([
                'state' => 0
            ]);
            $message = 'Etapa Deshabilitada';
        } else {
            $etapa->update([
                'state' => 1
            ]);
            $message = 'Etapa Habilitada';
        }
        return redirect()->route('etapas.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $etapa = GenState::find($id);
        if ($etapa) {
            $etapa->delete();
            return redirect()->route('etapas.index')->with('success', 'Etapa eliminada definitivamente');
        }

        return redirect()->route('etapas.index')->with('error', 'La Etapa no fue encontrada');
    }
}
