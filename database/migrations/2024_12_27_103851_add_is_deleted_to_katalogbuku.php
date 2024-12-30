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
        // Menambahkan kolom 'deleted_at' ke tabel 'katalogbuku' untuk soft deletes
        Schema::table('katalogbuku', function (Blueprint $table) {
            $table->softDeletes();  // Menambahkan kolom deleted_at
        });

       
    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom 'deleted_at' jika rollback
        Schema::table('katalogbuku', function (Blueprint $table) {
            $table->dropSoftDeletes();  // Menghapus kolom deleted_at
        });
    }
};
