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
        Schema::table('nilai', function (Blueprint $table) {
            $table->foreign('kategori_id', 'fk_nilai_to_kategori')->references('id')->on('kategori')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'fk_nilai_to_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('soal_id', 'fk_nilai_to_soal')->references('id')->on('soal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropForeign('fk_nilai_to_kategori');
            $table->dropForeign('fk_nilai_to_user');
            $table->dropForeign('fk_nilai_to_soal');
        });
    }
};