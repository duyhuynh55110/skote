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
        Schema::create('end_users', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 100)->unique();
            $table->string('calling_code', 20);
            $table->string('phone_number', 40);
            $table->integer('created_by');
            $table->timestamps();
            $table->integer('updated_by');
            $table->softDeletes();

            $table->unique(['calling_code', 'phone_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('end_users');
    }
};
