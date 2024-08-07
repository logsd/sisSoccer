<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTelefonoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PhoneOperator;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class telefonoController extends Controller implements HasMiddleware
{
        
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-telefono|crear-telefono|editar-telefono|desabilizar-telefono|eliminar-telefono'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-telefono'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-telefono'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-telefono'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-telefono'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $telefonos = PhoneOperator::latest()->get();
        return view('telefono.index',['telefonos' => $telefonos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('telefono.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTelefonoRequest $request)
    {
        try{
            DB::beginTransaction();
   
        // Validar y obtener los datos validados
        $validatedData = $request->validated();

        PhoneOperator::create($validatedData);
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('telefonos.index')->with('success', 'Teléfono registrado!');
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
    public function edit(PhoneOperator $telefono)
    {
        return view('telefono.edit',['telefono'=>$telefono]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTelefonoRequest $request, PhoneOperator $telefono)
    {
        $telefono->update($request->validated());
        return redirect()->route('telefonos.index')->with('success', 'Teléfono actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */

     
    public function destroy(string $id)
    {
        $message = '';
        $telefono = PhoneOperator::find($id);

        if ($telefono->state == 1) {
            $telefono->update([
                'state' => 0
            ]);
            $message = 'Operadora Deshabilitada';
        } else {
            $telefono->update([
                'state' => 1
            ]);
            $message = 'Operadora Habilitada';
        }
        return redirect()->route('telefonos.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $telefono = PhoneOperator::find($id);
        if ($telefono) {
            $telefono->delete();
            return redirect()->route('telefonos.index')->with('success', 'Operadora eliminada definitivamente');
        }

        return redirect()->route('telefonos.index')->with('error', 'La Operadora no fue encontrada');
    }
}
