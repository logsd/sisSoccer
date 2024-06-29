<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::insert([
            ['name' => 'Azuay'],
            ['name' => 'Bolívar'],
            ['name' => 'Cañar'],
            ['name' => 'Carchi'],
            ['name' => 'Chimborazo'],
            ['name' => 'Cotopaxi'],
            ['name' => 'El Oro'],
            ['name' => 'Esmeraldas'],
            ['name' => 'Galápagos'],
            ['name' => 'Guayas'],
            ['name' => 'Imbabura'],
            ['name' => 'Loja'],
            ['name' => 'Los Ríos'],
            ['name' => 'Manabí'],
            ['name' => 'Morona Santiago'],
            ['name' => 'Napo'],
            ['name' => 'Orellana'],
            ['name' => 'Pastaza'],
            ['name' => 'Pichincha'],
            ['name' => 'Santa Elena'],
            ['name' => 'Santo Domingo de los Tsáchilas'],
            ['name' => 'Sucumbíos'],
            ['name' => 'Tungurahua'],
            ['name' => 'Zamora Chinchipe'],
        ]);

    }
}
