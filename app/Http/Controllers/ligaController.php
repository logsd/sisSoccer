<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLigaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TaxpayerType;
use App\Models\League;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ligaController extends Controller implements HasMiddleware
{

    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-liga|crear-liga|editar-liga|mostrar-liga|desabilizar-liga|eliminar-liga'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-liga'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-liga'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('mostrar-liga'),only:['show']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-liga'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-liga'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ligas = League::with(['taxpayer'])->latest()->get();
        return view('liga.index',compact('ligas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contribuyentes = TaxpayerType::where('state',1)->get();
        return view('liga.create',compact('contribuyentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLigaRequest $request)
    {
        try {
            DB::beginTransaction();

            // Crear una nueva instancia de Club
            $liga = new League();

            // Validar y obtener los datos validados
            $validatedData = $request->validated();

            // Manejar el archivo del logo
            if ($request->hasFile('url_logo')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $liga->hanbleUploadImage($request->file('url_logo'));
                $validatedData['url_logo'] = $name;
            } else {
                $validatedData['url_logo'] = null;
            }
            // Manejar el archivo del logo
            if ($request->hasFile('url_sello')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $liga->hanbleUploadImage($request->file('url_sello'));
                $validatedData['url_sello'] = $name;
            } else {
                $validatedData['url_sello'] = null;
            }
            // Llenar el modelo con los datos validados
            $liga->fill($validatedData);

            // Guardar el modelo en la base de datos
            $liga->save();

            // Confirmar la transacción
            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('ligas.index')->with('success', 'Liga registrada!');
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
    public function edit(League $liga)
    {

        $contribuyentes = TaxpayerType::where('state',1)->get();
        return view('liga.edit',compact('liga','contribuyentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLigaRequest $request, League $liga)
    {
        try {
            DB::beginTransaction();

            // Manejar el archivo del logo
            if ($request->hasFile('url_logo')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name = $liga->hanbleUploadImage($request->file('url_logo'));
                //eliminar si existe imagen
                if (Storage::disk('public')->exists('/ligas/' . $liga->url_logo)) {
                    Storage::disk('public')->delete('/ligas/' . $liga->url_logo);
                }
            } else {
                $name = $liga->url_logo;
            }
            if ($request->hasFile('url_sello')) {
                // Asumimos que el método hanbleUploadImage guarda la imagen y devuelve el nombre del archivo
                $name1 = $liga->hanbleUploadImage($request->file('url_sello'));
                //eliminar si existe imagen
                if (Storage::disk('public')->exists('/ligas/' . $liga->url_sello)) {
                    Storage::disk('public')->delete('/ligas/' . $liga->url_sello);
                }
            } else {
                $name1 = $liga->url_sello;
            }

            $liga->fill([
                'name' => $request->name,
                'trade_name' => $request->trade_name,
                'business_name' => $request->business_name,
                'ruc' => $request->ruc,
                'direction' => $request->direction,
                'email' => $request->email,
                'constitution_date' => $request->constitution_date,
                'direction_web' => $request->direction_web,
                'slogan' => $request->slogan,
                'url_logo' => $name,
                'description' => $request->description,
                'url_sello' => $name1,
                'taxpayer_id' => $request->taxpayer_id,
            ]);

            $liga->save();

            // Confirmar la transacción
            DB::commit();
            return redirect()->route('ligas.index')->with('success', 'Liga actualizada correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('ligas.index')->with('error', 'Hubo un problema al actualizar el partido.');
        }
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $liga = League::find($id);
        $message = '';

        if ($liga) {
            if ($liga->state == 1) {
                $liga->update(['state' => 0]);
                $message = 'Liga Deshabilitada';
            } else {
                $liga->update(['state' => 1]);
                $message = 'Liga Habilitada';
            }
        }

        return redirect()->route('ligas.index')->with('success', $message);
    }
    
    public function forceDelete($id)
    {
        $liga = League::find($id);
        if ($liga) {
            $liga->delete();
            return redirect()->route('ligas.index')->with('success', 'Liga eliminada definitivamente');
        }

        return redirect()->route('ligas.index')->with('error', 'La Liga no fue encontrada');
    }
}
