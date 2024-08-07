<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReporteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GenReport;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class reporteController extends Controller implements HasMiddleware
{

        
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-reporte|crear-reporte|editar-reporte|desabilizar-reporte|eliminar-reporte'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-reporte'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-reporte'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-reporte'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-reporte'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportes = GenReport::latest()->get();
        return view('reporte.index',['reportes' => $reportes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reporte.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReporteRequest $request)
    {
        try{
            DB::beginTransaction();
   
        // Validar y obtener los datos validados
        $validatedData = $request->validated();

        // Crear la posición
        GenReport::create($validatedData);
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('reportes.index')->with('success', 'Reporte registrado!');
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
    public function edit(GenReport $reporte)
    {
        return view('reporte.edit',['reporte'=>$reporte]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreReporteRequest $request, GenReport $reporte)
    {
        $reporte->update($request->validated());
        return redirect()->route('reportes.index')->with('success', 'Reporte actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $reporte = GenReport::find($id);

        if($reporte->state == 1){
            $reporte->update([
                'state' => 0
            ]);
            $message = 'Reporte Deshabilitado';
        }else{
            $reporte->update([
                'state' => 1
            ]);
            $message = 'Reporte Habilitado';
        }
        return redirect()->route('reportes.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $reporte = GenReport::find($id);
        if ($reporte) {
            $reporte->delete();
            return redirect()->route('reportes.index')->with('success', 'Reporte eliminado definitivamente');
        }

        return redirect()->route('reportes.index')->with('error', 'El Reporte no fue encontrado');
    }
}
