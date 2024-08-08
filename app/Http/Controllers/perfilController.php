<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class perfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.index', compact('user'));
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
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $profile->id,
            'password' => 'nullable'
        ]);

         //verificar si existe password
         if (empty($request->password)){
            $request = Arr::except($request, array('password'));
       }else{
           $fieldHash = Hash::make($request->password);
           $request->merge(['password'=>$fieldHash]);

       }
       // Actualizar user
       $profile->update($request->all());

       return redirect()->route('profile.index')->with('success', 'Cambios guardados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
