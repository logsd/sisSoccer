<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Club;
use Exception;

class clubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::latest()->get();
        return view('club.index', ['clubs' => $clubs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('club.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClubRequest $request)
    {
        // Para depuración
        // dd($request);

        try {
            DB::beginTransaction();

            // Crear una nueva instancia de Club
            $club = new Club();

            // Validar y obtener los datos validados
            $validatedData = $request->validated();

            // Manejar el valor del checkbox 'current'
            $validatedData['current'] = $request->has('current') ? 1 : 0;

            // Manejar el archivo del logo
            if ($request->hasFile('logo')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $club->hanbleUploadImage($request->file('logo'));
                $validatedData['logo'] = $name;
            } else {
                $validatedData['logo'] = null;
            }

            // Llenar el modelo con los datos validados
            $club->fill($validatedData);

            // Guardar el modelo en la base de datos
            $club->save();

            // Confirmar la transacción
            DB::commit();

            // Redireccionar con un mensaje de éxito
            return redirect()->route('clubs.index')->with('success', 'Club registrado!');
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Manejar el error (puedes redireccionar con un mensaje de error o registrar el error)
            return redirect()->route('clubs.index')->with('error', 'Hubo un problema al registrar el club.');
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
    public function edit(Club $club)
    {
        return view('club.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClubRequest $request, Club $club)
    {
        try {
            DB::beginTransaction();

            // Manejar el archivo del logo
            if ($request->hasFile('logo')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $club->hanbleUploadImage($request->file('logo'));
                //eliminar si existe imagen
                if (Storage::disk('public')->exists('/clubs/'.$club->logo)){
                    Storage::disk('public')->delete('/clubs/'.$club->logo);
                }
            } else {
                $name = $club->logo;
            }

            $club->fill([
                'name' => $request->name,
                'trade_name' => $request->trade_name,
                'reason_social' => $request->reason_social,
                'ruc' => $request->ruc,
                'direction' => $request->direction,
                'email' => $request->email,
                'date_constion' => $request->date_constion,
                'direction_web' => $request->direction_web,
                'slogan' => $request->slogan,
                'logo' => $name,
                'description' => $request->description,
                'parish' => $request->parish,
                'current' => $request->current,
            ]);

            $club->save();

            // Confirmar la transacción
            DB::commit();
        } catch (Exception $e) {
        }
        return redirect()->route('clubs.index')->with('success', 'Club actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $club = Club::find($id);

        if ($club->state == 1) {
            $club->update([
                'state' => 0
            ]);
            $message = 'Club eliminado';
        } else {
            $club->update([
                'state' => 1
            ]);
            $message = 'Club restaurado';
        }
        return redirect()->route('clubs.index')->with('success', $message);
    }
}
