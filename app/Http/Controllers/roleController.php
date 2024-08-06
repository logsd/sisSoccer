<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('role.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        try {
            DB::beginTransaction();

            // Crear rol
            $rol = Role::create(['name' => $request->name]);

            $permissions = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            // Asignar permisos
            $rol->syncPermissions($permissions);

            DB::commit();

            return redirect()->route('roles.index')->with('success', 'Rol registrado');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('roles.index')->with('error', 'Error al registrar el rol: ' . $e->getMessage());
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
    public function edit(Role $role)
    {
        $permisos = Permission::all();
        return view('role.edit', compact('role', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permission' => 'required'
        ]);

        try {
            DB::beginTransaction();

            // Actualizar rol
             Role::where('id', $role->id)
                ->update([
                    'name' => $request->name
                ]);
            //Actualizar permisos
            
            $permissions = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
            $role->syncPermissions($permissions);


            DB::commit();

            return redirect()->route('roles.index')->with('success', 'Rol editado');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('roles.index')->with('error', 'Error al actualizar el rol: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::where('id',$id)->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado');
    }
}
