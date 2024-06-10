<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama' => 'ALGORITMA PEMROGRAMAN',
        ]);
        Kategori::create([
            'nama' => 'STRUKTUR DATA',
        ]);
        Kategori::create([
            'nama' => 'PEMROGRAMAN WEB',
        ]);
        Kategori::create([
            'nama' => 'PEMROGRAMAN MOBILE',
        ]);
    }
}
