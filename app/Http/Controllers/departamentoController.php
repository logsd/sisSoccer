<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartamentoRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
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
        return redirect()->route('departamentos.index')->with('success', 'Departamento registrado!');
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
        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado!');
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
            $message = 'Departamento eliminado logicamente';
        }else{
            $departamento->update([
                'state' => 1
            ]);
            $message = 'Departamento restaurado';
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
