<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataClubRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DateClub;
use App\Models\Club;
use Exception;

class dataClubController extends Controller
{
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
            $message = 'Telefono desabilitado';
        }else{
            $dataClub->update([
                'state' => 1
            ]);
            $message = 'Telefono restaurado';
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
