<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenEstadoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GenState;
use App\Models\LeagueExecutive;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class genEstadoController extends Controller implements HasMiddleware
{ 
       
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-genEstado|crear-genEstado|editar-genEstado|desabilizar-genEstado|eliminar-genEstado'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-genEstado'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-genEstado'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-genEstado'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-genEstado'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $genEstado = GenState::with(['leagueExecutive'])->latest()->get();
        return view('genEstado.index',['genEstados' => $genEstado]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $ejecutivos = LeagueExecutive ::where('state', 1)->get();        
        return view('genEstado.create',compact('ejecutivos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenEstadoRequest $request)
    {
        //
        try {
            DB::beginTransaction();
            $genEstado = GenState::create($request->validated());   
            $genEstado->save();
            DB::commit();
        }catch(Exception $e){
            //return $e;
            DB::rollBack();
        }
        return redirect()->route('genEstados.index')->with('success', 'Estado General registrado!');
    
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
    public function edit(GenState $genEstado)
    {
        //
        $ejecutivos = LeagueExecutive ::where('state', 1)->get();        
        return view('genEstado.edit',compact('ejecutivos','genEstado'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGenEstadoRequest $request, GenState $genEstado)
    {
        //
        try{
            DB::beginTransaction();

            $genEstado->fill([
                'name' => $request->name,
                'description' => $request->description,
                'league_executive_id' => $request->league_executive_id,
            ]);

            $genEstado->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('genEstados.index')->with('success', 'Estado General actualizado!');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $message = '';
        $genEstado = GenState::find($id);

        if($genEstado->state == 1){
            $genEstado->update([
                'state' => 0
            ]);
            $message = 'Estado General Deshabilitado';
        }else{
            $genEstado->update([
                'state' => 1
            ]);
            $message = 'Estado General Habilitado';
        }
        return redirect()->route('genEstados.index')->with('success', $message);
    }
    public function forceDelete($id)
    {
        $genEstado = GenState::find($id);
        if ($genEstado) {
            $genEstado->delete();
            return redirect()->route('genEstados.index')->with('success', 'Estado General eliminado definitivamente');
        }

        return redirect()->route('genEstados.index')->with('error', 'El estado general no fue encontrado');
    }

}
