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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hak_akses_id', 8);
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('id_kota');
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->timestamp("login_terakhir")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
