<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Department::create([
            'nama' => 'Wood Yard',
            'bussines_unit_id' => '1'
        ]);

        Department::create([
            'nama' => 'Fiberline',
            'bussines_unit_id' => '1'
        ]);

        Department::create([
            'nama' => 'Pulp Dryer',
            'bussines_unit_id' => '1'
        ]);

        Department::create([
            'nama' => 'Chemical Plant',
            'bussines_unit_id' => '1'
        ]);

        Department::create([
            'nama' => 'Technical',
            'bussines_unit_id' => '1'
        ]);

        Department::create([
            'nama' => 'Paper Machine',
            'bussines_unit_id' => '2'
        ]);

        Department::create([
            'nama' => 'Finishing',
            'bussines_unit_id' => '2'
        ]);

        Department::create([
            'nama' => 'PPIC & WH',
            'bussines_unit_id' => '2'
        ]);

        Department::create([
            'nama' => 'PCC & GCC',
            'bussines_unit_id' => '2'
        ]);

        Department::create([
            'nama' => 'IHPP',
            'bussines_unit_id' => '2'
        ]);

        Department::create([
            'nama' => 'Technical',
            'bussines_unit_id' => '2'
        ]);

        Department::create([
            'nama' => 'Water Treatment',
            'bussines_unit_id' => '3'
        ]);

        Department::create([
            'nama' => 'Turbine',
            'bussines_unit_id' => '3'
        ]);

        Department::create([
            'nama' => 'Power Boiler',
            'bussines_unit_id' => '3'
        ]);

        Department::create([
            'nama' => 'Recovery Boiler',
            'bussines_unit_id' => '3'
        ]);

        Department::create([
            'nama' => 'Evaporator',
            'bussines_unit_id' => '3'
        ]);

        Department::create([
            'nama' => 'RKE',
            'bussines_unit_id' => '3'
        ]);

        Department::create([
            'nama' => 'BCID',
            'bussines_unit_id' => '4'
        ]);

        Department::create([
            'nama' => 'SCM',
            'bussines_unit_id' => '4'
        ]);
    }
}
