<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            //encriptar pass
            $fieldHash = Hash::make($request->password);
            
            //modificar el valor de password en nuestro request
            $request->merge(['password' => $fieldHash]);
            // Crear user
            $user = User::create($request->all());
            //asignar rol
            $user->assignRole($request->role);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario registrado');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Error al registrar el Usuario: ' . $e->getMessage());
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
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
           
            //verificar si existe password
            if (empty($request->password)){
                 $request = Arr::except($request, array('password'));
            }else{
                $fieldHash = Hash::make($request->password);
                $request->merge(['password'=>$fieldHash]);

            }
            // Actualizar user
            $user->update($request->all());
            
            //Actualizar rol
            $user->syncRoles([$request->role]);


            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario editado');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Error al actualizar el Usuario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        //eliminar rol
        $rolUser = $user->getRoleNames()->first();
        $user->removeRole($rolUser);
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }
}
