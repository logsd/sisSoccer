<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
 
class cargoController extends Controller implements HasMiddleware
{
    
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-cargo|crear-cargo|editar-cargo|desabilizar-cargo|eliminar-cargo'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-cargo'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-cargo'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-cargo'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-cargo'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = Position::latest()->get();
        return view('cargo.index',['cargos' => $cargos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargoRequest $request)
    {
        try{
            DB::beginTransaction();

        // Validar y obtener los datos validados
        $validatedData = $request->validated();

        Position::create($validatedData);

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('cargos.index')->with('success', '¡Cargo registrado!');
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
    public function edit( Position $cargo)
    {
        return view('cargo.edit',['cargo'=>$cargo]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCargoRequest $request, Position $cargo)
    {
        $cargo->update($request->validated());
        return redirect()->route('cargos.index')->with('success', '¡Cargo actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $cargo = Position::find($id);

        if($cargo->state == 1){
            $cargo->update([
                'state' => 0
            ]);
            $message = 'Cargo Deshabilitado';
        }else{
            $cargo->update([
                'state' => 1
            ]);
            $message = 'Cargo Habilitado';
        }
        return redirect()->route('cargos.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $cargo = Position::find($id);
        if ($cargo) {
            $cargo->delete();
            return redirect()->route('cargos.index')->with('success', 'Cargo eliminado definitivamente');
        }

        return redirect()->route('cargos.index')->with('error', 'El Cargo no fue encontrado');
    }
}
