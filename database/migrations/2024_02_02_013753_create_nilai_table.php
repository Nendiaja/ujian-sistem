<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->string('jawabanUser');
            $table->foreignId('user_id')->nullable()->index('fk_nilai_to_user');
            $table->foreignId('soal_id')->nullable()->index('fk_nilai_to_soal');
            $table->foreignId('kategori_id')->nullable()->index('fk_nilai_to_kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
