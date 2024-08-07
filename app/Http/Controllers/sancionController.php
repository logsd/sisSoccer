<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSancionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TypeSanction;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class sancionController extends Controller implements HasMiddleware
{
        
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-sancion|crear-sancion|editar-sancion|desabilizar-sancion|eliminar-sancion'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-sancion'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-sancion'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-sancion'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-sancion'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sancion = TypeSanction::latest()->get();
        return view('sancion.index',['sancion' => $sancion]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sancion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSancionRequest $request)
    {
        try {
            DB::beginTransaction();
            $sancion = TypeSanction::create($request->validated());   
            $sancion->save();
            DB::commit();
        }catch(Exception $e){
            //return $e;
            DB::rollBack();
        }
        return redirect()->route('sancion.index')->with('success', 'Sanción registrada!');
    
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
    public function edit(TypeSanction $sancion)
    {
        //
        return view('sancion.edit',compact( 'sancion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSancionRequest $request, TypeSanction $sancion)
    {
        try {
            DB::beginTransaction();

            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $sancion->update($validatedData);

            DB::commit();
            return redirect()->route('sancion.index')->with('success', 'Sanción actualizada correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('sancion.index')->with('error', 'Hubo un problema al actualizar la Sanción.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $message = '';
        $sancion = TypeSanction::find($id);

        if($sancion->state == 1){
            $sancion->update([
                'state' => 0
            ]);
            $message = 'Sanción Deshabilitada';
        }else{
            $sancion->update([
                'state' => 1
            ]);
            $message = 'Sanción Habilitada';
        }
        return redirect()->route('sancion.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $sancion = TypeSanction::find($id);
        if ($sancion) {
            $sancion->delete();
            return redirect()->route('sancion.index')->with('success', 'Sanción eliminado definitivamente');
        }

        return redirect()->route('sancion.index')->with('error', 'La Sanción no fue encontrada');
    }

}