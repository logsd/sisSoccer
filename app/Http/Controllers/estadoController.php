<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstadoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StateParameter;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class estadoController extends Controller implements HasMiddleware
{ 
        
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-estado|crear-estado|editar-estado|desabilizar-estado|eliminar-estado'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-estado'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-estado'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-estado'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-estado'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = StateParameter::latest()->get();
        return view('estado.index',['estados' => $estados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadoRequest $request)
    {
        try{
            DB::beginTransaction();
   
        // Validar y obtener los datos validados
        $validatedData = $request->validated();

        StateParameter::create($validatedData);
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('estados.index')->with('success', 'Estado registrado!');
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
    public function edit(StateParameter $estado)
    {
        return view('estado.edit',['estado'=>$estado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEstadoRequest $request, StateParameter $estado)
    {
        $estado->update($request->validated());
        return redirect()->route('estados.index')->with('success', 'Estado actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $estado = StateParameter::find($id);

        if($estado->state == 1){
            $estado->update([
                'state' => 0
            ]);
            $message = 'Estado Deshabilitado';
        }else{
            $estado->update([
                'state' => 1
            ]);
            $message = 'Estado Habilitado';
        }
        return redirect()->route('estados.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $estado = StateParameter::find($id);
        if ($estado) {
            $estado->delete();
            return redirect()->route('estados.index')->with('success', 'Estado eliminado definitivamente');
        }

        return redirect()->route('estados.index')->with('error', 'El Estado no fue encontrado');
    }
}
