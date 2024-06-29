<?php

namespace Database\Seeders;

use App\Models\CivilStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CivilStatus::insert([
            ['name' => 'Soltero'],
            ['name' => 'Casado'],
            ['name' => 'Divorciado'],
            ['name' => 'Viudo'],
            ['name' => 'Unión Libre'],
        ]);
    }
}
