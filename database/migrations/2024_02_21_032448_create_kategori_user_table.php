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
        Schema::create('kategori_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->index('fk_category_user_pivot_to_kategori'); 
            $table->foreignId('user_id')->nullable()->index('fk_category_user_pivot_to_users');
            $table->integer('nilai_total')->nullable();     
            $table->enum('status', ['new', 'pending', 'approved'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_user');
    }
};
