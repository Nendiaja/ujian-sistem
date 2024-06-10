<?php

namespace Database\Seeders;

use App\Models\Rules;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rules::create([
            'waktu' => '30',
            'KKM' => '83',
        ]);
    }
}
