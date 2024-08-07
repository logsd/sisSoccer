<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeriodoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Period;
use App\Models\Team;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class periodoController extends Controller implements HasMiddleware
{
        
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-periodo|crear-periodo|editar-periodo|desabilizar-periodo|eliminar-periodo'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-periodo'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-periodo'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-periodo'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-periodo'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodos = Period::with(['team'])->latest()->get();
        return view('periodo.index',compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Team::where('state',1)->get();
        return view('periodo.create',compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeriodoRequest $request)
    {
        try {
            DB::beginTransaction();
            $periodo = Period::create($request->validated());   
            $periodo->save(); 
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('periodos.index')->with('success', 'Periodo registrado!');
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
    public function edit(Period $periodo)
    {
        $equipos = Team::where('state',1)->get();
        return view('periodo.edit',compact('periodo','equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePeriodoRequest $request, Period $periodo)
    {
        try {
            DB::beginTransaction();
    
            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $periodo->update($validatedData);
    
            DB::commit();
            return redirect()->route('periodos.index')->with('success', 'Periodo actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('periodos.index')->with('error', 'Hubo un problema al actualizar el equipo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $periodo = Period::find($id);

        if($periodo->state == 1){
            $periodo->update([
                'state' => 0
            ]);
            $message = 'Periodo Deshabilitado';
        }else{
            $periodo->update([
                'state' => 1
            ]);
            $message = 'Periodo Habilitado';
        }
        return redirect()->route('periodos.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $periodo = Period::find($id);
        if ($periodo) {
            $periodo->delete();
            return redirect()->route('periodos.index')->with('success', 'Periodo eliminado definitivamente');
        }

        return redirect()->route('periodos.index')->with('error', 'El Periodo no fue encontrado');
    }
}
