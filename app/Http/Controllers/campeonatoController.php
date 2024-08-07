<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampeonatoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Championship;
use App\Models\Category;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class campeonatoController extends Controller implements HasMiddleware
{

    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-campeonato|crear-campeonato|editar-campeonato|mostrar-campeonato|desabilizar-campeonato|eliminar-campeonato'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-campeonato'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-campeonato'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('mostrar-campeonato'),only:['show']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-campeonato'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-campeonato'), only:['forceDelete']),
        ];
     }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campeonatos = Championship::with(['category'])->latest()->get();
        return view('campeonato.index',compact('campeonatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Category::where('state', 1)->get();
        return view('campeonato.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampeonatoRequest $request)
    {
        try {
            DB::beginTransaction();
            $campeonato = new Championship();
            $campeonato->fill([
                'name' => $request->name,
                'year' => $request->year,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'from' => $request->from,
                'until' => $request->until,
                'description' => $request->description,
                'observation' => $request->observation,
                'category_id' => $request->category_id
            ]);
            $campeonato->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('campeonatos.index')->with('success', '¡Datos registrados!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Championship $campeonato)
    {
        return view('campeonato.show',compact('campeonato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Championship $campeonato)
    {
        $categorias = Category::where('state', 1)->get();
        return view('campeonato.edit',compact('campeonato','categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCampeonatoRequest $request, Championship $campeonato)
    {
        try{
            DB::beginTransaction();

            $campeonato->fill([
                'name' => $request->name,
                'year' => $request->year,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'from' => $request->from,
                'until' => $request->until,
                'description' => $request->description,
                'observation' => $request->observation,
                'category_id' => $request->category_id
            ]);

            $campeonato->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('campeonatos.index')->with('success', '¡Campeonato actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $campeonato = Championship::find($id);

        if($campeonato->state == 1){
            $campeonato->update([
                'state' => 0
            ]);
            $message = 'Campeonato Deshabilitado';
        }else{
            $campeonato->update([
                'state' => 1
            ]);
            $message = 'Campeonato Habilitado';
        }
        return redirect()->route('campeonatos.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $campeonato = Championship::find($id);
        if ($campeonato) {
            $campeonato->delete();
            return redirect()->route('campeonatos.index')->with('success', 'Campeonato eliminado definitivamente');
        }

        return redirect()->route('campeonatos.index')->with('error', 'El Campeonato no fue encontrado');
    }
}
