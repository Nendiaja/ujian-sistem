<?php

namespace Database\Seeders;

use App\Models\Opsi;
use App\Models\Soal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Soal_dan_opsi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $soal = Soal::create([
            'soal' => 'AHMAD MAHASISWA',
            'kategori_id' => 1,
        ]);

        $opsi = Opsi::create([
            
            'soal_id' => $soal->id,
            'a' => 'pnp',
            'b' => 'itp',
            'c' => 'unri',
            'd' => 'uir',
            'jawaban' => 'pnp',
        ]);
        $soal = Soal::create([
            'soal' => 'KAGUYA ANIME',
            'kategori_id' => 1,
        ]);

        $opsi = Opsi::create([
            
            'soal_id' => $soal->id,
            'a' => 'naruto',
            'b' => 'nalar',
            'c' => 'apasi',
            'd' => 'kocak',
            'jawaban' => 'naruto',
        ]);
        $soal = Soal::create([
            'soal' => 'GUSION ROLE',
            'kategori_id' => 1,
        ]);

        $opsi = Opsi::create([
            
            'soal_id' => $soal->id,
            'a' => 'fighter',
            'b' => 'assasin',
            'c' => 'support',
            'd' => 'tank',
            'jawaban' => 'assasin',
        ]);
        $soal = Soal::create([
            'soal' => 'HILOS ROLE',
            'kategori_id' => 2,
        ]);

        $opsi = Opsi::create([
            
            'soal_id' => $soal->id,
            'a' => 'fighter',
            'b' => 'assasin',
            'c' => 'support',
            'd' => 'tank',
            'jawaban' => 'tank',
        ]);
    }
}
