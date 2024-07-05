<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEtapaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GenState;
use App\Models\LeagueExecutive;
use Exception;


class etapaController extends Controller
{
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
        return redirect()->route('etapas.index')->with('success', 'Estapa actualizada!');
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
            $message = 'Etapa Desabilitada';
        } else {
            $etapa->update([
                'state' => 1
            ]);
            $message = 'Etapa restaurada';
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

        return redirect()->route('etapas.index')->with('error', 'La Etapa no fue encontrado');
    }
}
