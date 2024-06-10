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
        Schema::table('kategori_user', function (Blueprint $table) {
            $table->foreign('kategori_id', 'fk_category_user_pivot_to_kategori')
            ->references('id')->on('kategori')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_category_user_pivot_to_users')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_user', function (Blueprint $table) {
            $table->dropForeign('fk_category_user_pivot_to_kategori');
            $table->dropForeign('fk_category_user_pivot_to_users');

        });
    }
};
