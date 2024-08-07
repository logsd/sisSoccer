<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContribuyenteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TaxpayerType;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class contribuyenteController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-contribuyente|crear-contribuyente|editar-contribuyente|desabilizar-contribuyente|eliminar-contribuyente'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-contribuyente'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-contribuyente'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-contribuyente'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-contribuyente'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contribuyentes = TaxpayerType::latest()->get();
        return view('contribuyente.index',['contribuyentes' => $contribuyentes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contribuyente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContribuyenteRequest $request)
    {
        // Para depuración
        // dd($request);
    
        try {
            DB::beginTransaction();
            
            // Crear una nueva instancia de Club
            $contribuyente = new TaxpayerType();
    
            // Validar y obtener los datos validados
            $validatedData = $request->validated();
    
            // Manejar el valor del checkbox 'current'
            $validatedData['a_cont'] = $request->has('a_cont') ? 1 : 0;
    
            // Llenar el modelo con los datos validados
            $contribuyente->fill($validatedData);
    
            // Guardar el modelo en la base de datos
            $contribuyente->save();
    
            // Confirmar la transacción
            DB::commit();
    
            // Redireccionar con un mensaje de éxito
            return redirect()->route('contribuyentes.index')->with('success', '¡Contribuyente registrado!');
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            // Manejar el error
            return redirect()->route('contribuyentes.index')->with('error', 'Hubo un problema al registrar el Contribuyente.');
        }
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
    public function edit(TaxpayerType $contribuyente)
    {
        return view('contribuyente.edit',['contribuyente'=>$contribuyente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreContribuyenteRequest $request,TaxpayerType $contribuyente)
    {
        $contribuyente->update($request->validated());
        return redirect()->route('contribuyentes.index')->with('success', '¡Contribuyente actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $contribuyente = TaxpayerType::find($id);

        if($contribuyente->state == 1){
            $contribuyente->update([
                'state' => 0
            ]);
            $message = 'Contribuyente Deshabilitado';
        }else{
            $contribuyente->update([
                'state' => 1
            ]);
            $message = 'Contribuyente Habilitado';
        }
        return redirect()->route('contribuyentes.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $contribuyente = TaxpayerType::find($id);
        if ($contribuyente) {
            $contribuyente->delete();
            return redirect()->route('contribuyentes.index')->with('success', 'Contribuyente eliminado definitivamente');
        }

        return redirect()->route('contribuyentes.index')->with('error', 'El Contribuyente no fue encontrado');
    }
}
