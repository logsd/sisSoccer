<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Club;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class clubController extends Controller implements HasMiddleware
{
    
    public static function middleware(): array {
        return [ 
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-club'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-club'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('mostrar-club'),only:['show']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-club'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-club'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            return redirect()->route('dataClubs.index')->with('success', '¡Club registrado!');
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Manejar el error (puedes redireccionar con un mensaje de error o registrar el error)
            return redirect()->route('dataClubs.index')->with('error', 'Hubo un problema al registrar el club.');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        return view('club.show',compact('club'));
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
                if (Storage::disk('public')->exists('/clubs/' . $club->logo)) {
                    Storage::disk('public')->delete('/clubs/' . $club->logo);
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
                'parish' => $request->parish
            ]);

            $club->save();

            // Confirmar la transacción
            DB::commit();
        } catch (Exception $e) {
        }
        return redirect()->route('dataClubs.index')->with('success', 'Club actualizado!');
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
            $message = 'Club Deshabilitado';
        } else {
            $club->update([
                'state' => 1
            ]);
            $message = 'Club Habilitado';
        }
        return redirect()->route('dataClubs.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $club = Club::find($id);

        if ($club) {
            try {
                DB::beginTransaction();

                // Eliminar la imagen si existe
                if (Storage::disk('public')->exists('clubs/' . $club->logo)) {
                    Storage::disk('public')->delete('clubs/' . $club->logo);
                }

                // Eliminar el registro del club
                $club->delete();

                DB::commit();

                return redirect()->route('dataClubs.index')->with('success', 'Club eliminado definitivamente');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('dataClubs.index')->with('error', 'Hubo un problema al eliminar el club.');
            }
        }

        return redirect()->route('dataClubs.index')->with('error', 'El Club no fue encontrado');
    }
}
