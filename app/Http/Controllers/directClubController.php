<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectClubRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Championship;
use App\Models\Club;
use App\Models\DirectClub;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class directClubController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-directClub|crear-directClub|editar-directClub|desabilizar-directClub|eliminar-directClub'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-directClub'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-directClub'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-directClub'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-directClub'), only:['forceDelete']),
        ];
     }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directivos = DirectClub::with(['championship','club'])->latest()->get();
        return view('directClub.index',compact('directivos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clubs = Club::where('state',1)->get();
        $campeonatos = Championship::where('state',1)->get();
        return view('directClub.create',compact('clubs','campeonatos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDirectClubRequest $request)
    {
        try {
            DB::beginTransaction();
            $directClub = DirectClub::create($request->validated());   
            $directClub->save(); 
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('directClubs.index')->with('success', '¡Directivo registrado!');
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
    public function edit(DirectClub $directClub)
    {
        $clubs = Club::where('state',1)->get();
        $campeonatos = Championship::where('state',1)->get();
        return view('directClub.edit',compact('directClub','clubs','campeonatos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDirectClubRequest $request, DirectClub $directClub)
    {
        try {
            DB::beginTransaction();
    
            // Obtener los datos validados del request
            $validatedData = $request->validated();

            $directClub->update($validatedData);
    
            DB::commit();
            return redirect()->route('directClubs.index')->with('success', '¡Directivo actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('directClubs.index')->with('error', 'Hubo un problema al actualizar el directivo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $directClub = DirectClub::find($id);

        if($directClub->state == 1){
            $directClub->update([
                'state' => 0
            ]);
            $message = 'Directivo Deshabilitado';
        }else{
            $directClub->update([
                'state' => 1
            ]);
            $message = 'Directivo Habilitado';
        }
        return redirect()->route('directClubs.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $directClub = DirectClub::find($id);
        if ($directClub) {
            $directClub->delete();
            return redirect()->route('directClubs.index')->with('success', 'Directivo eliminado definitivamente');
        }

        return redirect()->route('directClubs.index')->with('error', 'El Directivo no fue encontrado');
    }
}
