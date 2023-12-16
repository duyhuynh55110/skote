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
        Schema::table('products', function (Blueprint $table) {
            $table->fullText(['name_en']);
            $table->fullText(['name_vi']);
            $table->fullText(['name_en', 'name_vi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropFullText(['name_en']);
            $table->dropFullText(['name_vi']);
            $table->dropFullText(['name_en', 'name_vi']);
        });
    }
};
