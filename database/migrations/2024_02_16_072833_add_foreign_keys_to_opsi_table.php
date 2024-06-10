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
        Schema::table('opsi', function (Blueprint $table) {
            $table->foreign('soal_id', 'fk_opsi_to_soal')->references('id')->on('soal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('opsi', function (Blueprint $table) {
            $table->dropForeign('fk_opsi_to_soal');
        });
    }
};
