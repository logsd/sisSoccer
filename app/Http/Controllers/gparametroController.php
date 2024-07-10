<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGparametroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneralParameter;
use App\Models\CivilStatus;
use App\Models\StateParameter;
use App\Models\PhoneOperator;
use App\Models\TaxpayerType;
use App\Models\TypeParameter;
use App\Models\TypeSanction;
use Exception;

class gparametroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gparametro = GeneralParameter::with(['stateParameter','civilStatus','phoneOperator','taxpayerType','typeParameter','typeSanction'])->latest()->get();
        return view('gparametro.index',['gparametros' => $gparametro]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados = StateParameter::where('state', 1)->get();        
        $estadosCiviles = CivilStatus::where('state', 1)->get();        
        $telefonos = PhoneOperator::where('state', 1)->get();
        $contribuyentes = TaxpayerType::where('state', 1)->get();        
        $parametros = TypeParameter::where('state', 1)->get();        
        $sanciones = TypeSanction::where('state', 1)->get();        
        return view('gparametro.create',compact('estados', 'estadosCiviles','telefonos','contribuyentes','parametros','sanciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGparametroRequest $request)
    {
        try {
            DB::beginTransaction();
            $gparametro = GeneralParameter::create($request->validated());   
            $gparametro->save();
            DB::commit();
        }catch(Exception $e){
            //return $e;
            DB::rollBack();
        }
        return redirect()->route('gparametros.index')->with('success', 'Parametros Generales registrado!');
    
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
    public function edit(GeneralParameter $gparametro)
    {
        $estados = StateParameter::where('state', 1)->get();        
        $estadosCiviles = CivilStatus::where('state', 1)->get();        
        $telefonos = PhoneOperator::where('state', 1)->get();
        $contribuyentes = TaxpayerType::where('state', 1)->get();        
        $parametros = TypeParameter::where('state', 1)->get();        
        $sanciones = TypeSanction::where('state', 1)->get();        
        return view('gparametro.edit',compact('gparametro','estados', 'estadosCiviles','telefonos','contribuyentes','parametros','sanciones'));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGparametroRequest $request, GeneralParameter $gparametro)
    {
        try{
            DB::beginTransaction();

            $gparametro->fill([
                'state_parameters_id' => $request->state_parameters_id,
                'civil_status_id' => $request->civil_status_id,    
                'phone_operator_id' => $request->phone_operator_id,
                'taxpayer_types_id' => $request->taxpayer_types_id,
                'type_parameters_id' => $request->type_parameters_id,
                'type_sanctions_id' => $request->type_sanctions_id,
            ]);

            $gparametro->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('gparametros.index')->with('success', 'Parametro General actualizado!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $gparametro = GeneralParameter::find($id);

        if($gparametro->state == 1){
            $gparametro->update([
                'state' => 0
            ]);
            $message = 'Parametro General Desabilitado';
        }else{
            $gparametro->update([
                'state' => 1
            ]);
            $message = 'Parametro General restaurado';
        }
        return redirect()->route('gparametros.index')->with('success', $message);
    }
    public function forceDelete($id)
    {
        $gparametro = GeneralParameter::find($id);
        if ($gparametro) {
            $gparametro->delete();
            return redirect()->route('gparametros.index')->with('success', 'Parametro General eliminado definitivamente');
        }

        return redirect()->route('gparametros.index')->with('error', 'El Parametro General no fue encontrado');
    }

}
