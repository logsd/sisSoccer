<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLigaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\League;
use Exception;

class ligaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ligas = League::latest()->get();
        return view('liga.index',['ligas' => $ligas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('liga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLigaRequest $request)
    {
        try{
            DB::beginTransaction();
            League::create($request->validated());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('ligas.index')->with('success', 'Liga registrada!');
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
    public function edit(League $liga)
    {

        return view('liga.edit',['liga'=>$liga]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLigaRequest $request, League $liga)
    {
        $liga->update($request->validated());
        return redirect()->route('ligas.index')->with('success', 'Liga actualizada!');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $liga = League::find($id);
        $message = '';

        if ($liga) {
            if ($liga->state == 1) {
                $liga->update(['state' => 0]);
                $message = 'Liga eliminado lógicamente';
            } else {
                $liga->update(['state' => 1]);
                $message = 'Liga restaurado';
            }
        }

        return redirect()->route('ligas.index')->with('success', $message);
    }
    
    public function forceDelete($id)
    {
        $liga = League::find($id);
        if ($liga) {
            $liga->delete();
            return redirect()->route('ligas.index')->with('success', 'Liga eliminado definitivamente');
        }

        return redirect()->route('ligas.index')->with('error', 'La Liga no fue encontrada');
    }
}
