<?php

namespace Database\Seeders;

use App\Models\BussinesUnit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BussinesUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BussinesUnit::create([
            'nama' => 'Riau Pulp',
        ]);

        BussinesUnit::create([
            'nama' => 'Riau Paper',
        ]);

        BussinesUnit::create([
            'nama' => 'Riau Power',
        ]);

        BussinesUnit::create([
            'nama' => 'Share Service',
        ]);
    }
}
