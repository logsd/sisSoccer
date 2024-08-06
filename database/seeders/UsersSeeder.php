<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /*$user = User::create([
            "name"=> "Leo",
            "email"=> "admin@gmail.com",
            "password"=> bcrypt("12345678")
        ]);*/

        //Usuario Administrador

        $rol = Role::create(['name' => 'administrador']);
        $permisos = Permission::pluck('id', 'id')->all();
        $rol->syncPermissions($permisos);

        $user = User::find(1);
        $user->assignRole('administrador');
    }
}
