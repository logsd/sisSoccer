<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenTelefonoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GenTelephone;
use App\Models\Employee;
use App\Models\LeagueExecutive;
use Exception;

class genTelefonoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $genTelefono = GenTelephone::with(['leagueExecutive','employee'])->latest()->get();
        return view('genTelefono.index',['genTelefonos' => $genTelefono]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ejecutivos = LeagueExecutive ::where('state', 1)->get();        
        $empleados = Employee::where('state', 1)->get();
        return view('genTelefono.create',compact('ejecutivos', 'empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenTelefonoRequest $request)
    {
        try {
            DB::beginTransaction();
            $genTelefono = GenTelephone::create($request->validated());   
            $genTelefono->save();
            DB::commit();
        }catch(Exception $e){
            //return $e;
            DB::rollBack();
        }
        return redirect()->route('genTelefonos.index')->with('success', 'Telegono registrado!');
    
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
    public function edit(GenTelephone $genTelefono)
    {
        //
        $ejecutivos = LeagueExecutive ::where('state', 1)->get();        
        $empleados = Employee::where('state', 1)->get();
        return view('genTelefono.edit',compact( 'genTelefono','ejecutivos', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGenTelefonoRequest $request, GenTelephone $genTelefono)
    {
        try{
            DB::beginTransaction();

            $genTelefono->fill([
                'number' => $request->number,
                'description' => $request->description,
                'league_executive_id' => $request->league_executive_id,    
                'employee_id' => $request->employee_id,
            ]);

            $genTelefono->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('genTelefonos.index')->with('success', 'Telefono actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $message = '';
        $genTelefono = GenTelephone::find($id);

        if($genTelefono->state == 1){
            $genTelefono->update([
                'state' => 0
            ]);
            $message = 'Telefono Desabilitado';
        }else{
            $genTelefono->update([
                'state' => 1
            ]);
            $message = 'Telefono restaurado';
        }
        return redirect()->route('genTelefonos.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $genTelefono = GenTelephone::find($id);
        if ($genTelefono) {
            $genTelefono->delete();
            return redirect()->route('genTelefonos.index')->with('success', 'Telefono eliminado definitivamente');
        }

        return redirect()->route('genTelefonos.index')->with('error', 'El Telefono no fue encontrado');
    }

}