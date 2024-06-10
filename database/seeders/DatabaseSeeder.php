<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\OpsiSeeder;
use Database\Seeders\RuleSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\BussinesUnitSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KategoriSeeder::class,
            Soal_dan_opsi::class,
            dualimaSeeder::class,
            BussinesUnitSeeder::class,
            DepartmentSeeder::class,
            RuleSeeder::class,
        ]);
    }
}
