<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarnetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\License;
use App\Models\Player;
use App\Models\Championship;
use Exception;


class carnetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carnet = License::with(['player','championship'])->latest()->get();
        return view('carnet.index',['carnets' => $carnet]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jugadores = Player ::where('state', 1)->get();        
        $campeonatos = Championship::where('state', 1)->get();
        return view('carnet.create',compact('jugadores', 'campeonatos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarnetRequest $request)
    {
        //
        try {
            DB::beginTransaction();
            $carnet = License::create($request->validated());   
            $carnet->save();
            DB::commit();
        }catch(Exception $e){
            //return $e;
            DB::rollBack();
        }
        return redirect()->route('carnets.index')->with('success', 'Carnet registrado!');
    
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
    public function edit(License $carnet)
    {
        //
        $jugadores = Player ::where('state', 1)->get();        
        $campeonatos = Championship::where('state', 1)->get();
        return view('carnet.edit',compact('carnet', 'jugadores', 'campeonatos'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCarnetRequest $request, License $carnet)
    {
        //
        try{
            DB::beginTransaction();

            $carnet->fill([
                'cod' => $request->cod,
                'player_id' => $request->player_id,    
                'championship_id' => $request->championship_id,
            ]);

            $carnet->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('carnets.index')->with('success', 'carnet actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $message = '';
        $carnet = License::find($id);

        if($carnet->state == 1){
            $carnet->update([
                'state' => 0
            ]);
            $message = 'Carnet Desabilitado';
        }else{
            $carnet->update([
                'state' => 1
            ]);
            $message = 'Carnet restaurado';
        }
        return redirect()->route('carnets.index')->with('success', $message);
    }
    public function forceDelete($id)
    {
        $carnet = License::find($id);
        if ($carnet) {
            $carnet->delete();
            return redirect()->route('carnets.index')->with('success', 'Carnet eliminado definitivamente');
        }

        return redirect()->route('carnets.index')->with('error', 'El carnet no fue encontrado');
    }

}
