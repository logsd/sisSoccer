<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataClubRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DateClub;
use App\Models\Club;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class dataClubController extends Controller implements HasMiddleware
{

        
    public static function middleware(): array {
        return [ 
          new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('ver-dataClub|crear-dataClub|editar-dataClub|desabilizar-dataClub|eliminar-dataClub|ver-club|crear-club|editar-club|mostrar-club|desabilizar-club|eliminar-club'),only:['index']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('crear-dataClub'), only:['create','store']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('editar-dataClub'),only:['edit','update']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('desabilizar-dataClub'), only:['destroy']),
         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('eliminar-dataClub'), only:['forceDelete']),
        ];
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::latest()->get();
        $dataClubs = DateClub::with(['club'])->latest()->get();
        return view('dataClub.index', compact('dataClubs','clubs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clubs = Club::where('state', 1)->get();
        return view('dataClub.create',compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDataClubRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataClub = new DateClub();
            $dataClub->fill([
                'phone' => $request->phone,
                'operator' => $request->operator,
                'description' => $request->description,
                'club_id' => $request->club_id
            ]);
            $dataClub->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('dataClubs.index')->with('success', 'Datos registrados!');
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
    public function edit(DateClub $dataClub)
    {
        $clubs = Club::where('state', 1)->get();
        return view('dataClub.edit',compact('dataClub','clubs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDataClubRequest $request, DateClub $dataClub)
    {
        try{
            DB::beginTransaction();

            $dataClub->fill([
                'phone' => $request->phone,
                'operator' => $request->operator,
                'description' => $request->description,
                'club_id' => $request->club_id
            ]);

            $dataClub->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('dataClubs.index')->with('success', 'Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $dataClub = DateClub::find($id);

        if($dataClub->state == 1){
            $dataClub->update([
                'state' => 0
            ]);
            $message = 'Teléfono Deshabilitado';
        }else{
            $dataClub->update([
                'state' => 1
            ]);
            $message = 'Teléfono Habilitado';
        }
        return redirect()->route('dataClubs.index')->with('success', $message);
    }

    public function forceDelete($id)
    {
        $dataClub = DateClub::find($id);
        if ($dataClub) {
            $dataClub->delete();
            return redirect()->route('dataClubs.index')->with('success', 'Telefono Club eliminado definitivamente');
        }

        return redirect()->route('dataClubs.index')->with('error', 'El Telefono Club no fue encontrado');
    }
    
}
