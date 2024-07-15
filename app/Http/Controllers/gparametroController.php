<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGparametroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GeneralParameter;
use App\Models\CivilStatus;
use App\Models\StateParameter;
use App\Models\PhoneOperator;
use App\Models\TaxpayerType;
use App\Models\TypeParameter;
use App\Models\TypeSanction;
use Exception;

class gparametroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gparametro = GeneralParameter::all();
       
        return view('gparametro.index',compact('gparametro'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGparametroRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('gparametro.show',compact('gparametro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralParameter $gparametro)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGparametroRequest $request, GeneralParameter $gparametro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
