<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEjecutivoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeagueExecutive;
use Exception;

class ejecutivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ejecutivos = LeagueExecutive::latest()->get();
        return view('ejecutivo.index',['ejecutivos' => $ejecutivos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ejecutivo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEjecutivoRequest $request)
    {
        // Para depuración
    // dd($request);
    
        try {
            DB::beginTransaction();
            
            // Crear una nueva instancia de Club
            $ejecutivo = new LeagueExecutive();
    
            // Validar y obtener los datos validados
            $validatedData = $request->validated();
    
            // Manejar el archivo del logo
            if ($request->hasFile('img_path')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $ejecutivo->hanbleUploadImage($request->file('img_path'));
                $validatedData['img_path'] = $name;
            } else {
                $validatedData['img_path'] = null;
            }
    
            // Llenar el modelo con los datos validados
            $ejecutivo->fill($validatedData);
    
            // Guardar el modelo en la base de datos
            $ejecutivo->save();
    
            // Confirmar la transacción
            DB::commit();
    
            // Redireccionar con un mensaje de éxito
            return redirect()->route('ejecutivos.index')->with('success', '¡Ejecutivo registrado!');
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
    
            // Manejar el error (puedes redireccionar con un mensaje de error o registrar el error)
            return redirect()->route('ejecutivos.index')->with('error', 'Hubo un problema al registrar el Ejecutivo.');
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
    public function edit(LeagueExecutive $ejecutivo)
    {
        return view('ejecutivo.edit',['ejecutivo'=>$ejecutivo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEjecutivoRequest $request, LeagueExecutive $ejecutivo)
    {
        try {
            DB::beginTransaction();

            // Manejar el archivo del logo
            if ($request->hasFile('img_path')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $ejecutivo->hanbleUploadImage($request->file('img_path'));
                //eliminar si existe imagen
                if (Storage::disk('public')->exists('/ejecutivos/'.$ejecutivo->img_path)){
                    Storage::disk('public')->delete('/ejecutivos/'.$ejecutivo->img_path);
                }
            } else {
                $name = $ejecutivo->img_path;
            }

            $ejecutivo->fill([
                'dni' => $request->dni,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'address' => $request->address,
                'email' => $request->email,
                'img_path' => $name,
            ]);

            $ejecutivo->save();

            // Confirmar la transacción
            DB::commit();
        } catch (Exception $e) {
        }
        return redirect()->route('ejecutivos.index')->with('success', '¡Ejecutivo actualizado!');
    }
    

    public function remove(){
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $ejecutivo = LeagueExecutive::find($id);

        if($ejecutivo->state == 1){
            $ejecutivo->update([
                'state' => 0
            ]);
            $message = 'Ejecutivo Deshabilitado';
        }else{
            $ejecutivo->update([
                'state' => 1
            ]);
            $message = 'Ejecutivo Habilitado';
        }
        return redirect()->route('ejecutivos.index')->with('success', $message);
    }
    
    public function forceDelete($id)
    {
        $ejecutivo = LeagueExecutive::find($id);
        if ($ejecutivo) {
            $ejecutivo->delete();
            return redirect()->route('ejecutivos.index')->with('success', 'Ejecutivo eliminado definitivamente');
        }

        return redirect()->route('ejecutivos.index')->with('error', 'El Ejecutivo no fue encontrado');
    }
}
