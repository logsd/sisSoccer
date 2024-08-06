<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenOficinaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GenOffice;
use App\Models\GenReport;
use App\Models\CommissionLeague;
use App\Models\GenCharge;
use App\Models\Club;
use Exception;

class genOficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $genOficina = GenOffice::with(['genReport','genCharge','commissionLeague','club'])->latest()->get();
        return view('genOficina.index',['genOficinas' => $genOficina]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $reportes = GenReport ::where('state', 1)->get();        
        $comisiones = CommissionLeague::where('state', 1)->get();
        $cargas = GenCharge::where('state', 1)->get();
        $clubs = Club::where('state', 1)->get();
        return view('genOficina.create',compact('reportes','comisiones','cargas', 'clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenOficinaRequest $request)
    {
        //
        try {
            DB::beginTransaction();
            $genOficina = GenOffice::create($request->validated());   
            $genOficina->save();
            DB::commit();
        }catch(Exception $e){
            //return $e;
            DB::rollBack();
        }
        return redirect()->route('genOficinas.index')->with('success', 'Oficina General registrada!');
    
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
    public function edit(GenOffice $genOficina)
    {
        $reportes = GenReport ::where('state', 1)->get();        
        $comisiones = CommissionLeague::where('state', 1)->get();
        $cargas = GenCharge::where('state', 1)->get();
        $clubs = Club::where('state', 1)->get();
        return view('genOficina.edit',compact('genOficina','reportes','comisiones','cargas', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGenOficinaRequest $request, GenOffice $genOficina)
    {
        //
        try{
            DB::beginTransaction();

            $genOficina->fill([
                'name' => $request->name,
                'short_name' => $request->short_name,
                'address' => $request->address,
                'report_id' => $request->report_id,    
                'commission_league_id' => $request->commission_league_id,    
                'charge_id' => $request->charge_id,    
                'club_id' => $request->club_id,    
            ]);

            $genOficina->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('genOficinas.index')->with('success', 'Oficina general actualizada!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $message = '';
        $genOficina = GenOffice::find($id);

        if($genOficina->state == 1){
            $genOficina->update([
                'state' => 0
            ]);
            $message = 'Oficina General Deshabilitado';
        }else{
            $genOficina->update([
                'state' => 1
            ]);
            $message = 'Oficina General Habilitada';
        }
        return redirect()->route('genOficinas.index')->with('success', $message);
    }
    public function forceDelete($id)
    {
        $genOficina = GenOffice::find($id);
        if ($genOficina) {
            $genOficina->delete();
            return redirect()->route('genOficinas.index')->with('success', 'Oficina General eliminada definitivamente');
        }

        return redirect()->route('genOficinas.index')->with('error', 'La Oficina General no fue encontrada');
    }
}
