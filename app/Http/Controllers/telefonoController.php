<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTelefonoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PhoneOperator;
use Exception;

class telefonoController extends Controller
{
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

        // Manejar el valor del checkbox 'vg'
        $validatedData['vg'] = $request->has('vg') ? 1 : 0;
        // Crear la posición
        PhoneOperator::create($validatedData);
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('telefonos.index')->with('success', 'Telefono registrado!');
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
        return redirect()->route('telefonos.index')->with('success', 'Telefono actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        try {
            $phone = PhoneOperator::findOrFail($id);
            $phone->delete();
            $message = 'Cargo eliminado';

            return redirect()->route('telefonos.index')->with('success', $message);
        } catch (Exception $e) {
            $message = 'Hubo un problema al eliminar el teléfono.';
            return redirect()->route('telefonos.index')->with('success', $message);
        }
    }
}
