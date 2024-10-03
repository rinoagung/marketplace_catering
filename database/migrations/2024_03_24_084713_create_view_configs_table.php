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
        Schema::create('view_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('alamat', 85)->nullable();
            $table->string('no_telp', 24)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('situs_web')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_configs');
    }
};
