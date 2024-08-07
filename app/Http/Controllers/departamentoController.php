<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartamentoRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DepartamentoController extends Controller implements HasMiddleware
{

    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-departamento|crear-departamento|editar-departamento|desabilizar-departamento|eliminar-departamento'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-departamento'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-departamento'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-departamento'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-departamento'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = Department::latest()->get();
        return view('departamento.index',['departamentos' => $departamentos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departamento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartamentoRequest $request)
    {
        try{
            DB::beginTransaction();
            Department::create($request->validated());
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('departamentos.index')->with('success', '¡Departamento registrado!');
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
    public function edit(Department $departamento)
    {
        return view('departamento.edit',['departamento'=>$departamento]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartamentoRequest $request, Department $departamento)
    {
        $departamento->update($request->validated());
        return redirect()->route('departamentos.index')->with('success', '¡Departamento actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $departamento = Department::find($id);

        if($departamento->state == 1){
            $departamento->update([
                'state' => 0
            ]);
            $message = 'Departamento Deshabilitado ';
        }else{
            $departamento->update([
                'state' => 1
            ]);
            $message = 'Departamento Habilitado';
        }
        return redirect()->route('departamentos.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $departamento = Department::find($id);
        if ($departamento) {
            $departamento->delete();
            return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado definitivamente');
        }

        return redirect()->route('departamentos.index')->with('error', 'El departamento no fue encontrado');
    }
}
