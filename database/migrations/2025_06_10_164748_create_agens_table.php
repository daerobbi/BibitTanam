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
        Schema::create('agens', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->timestamps();
            $table->string('nama');
            $table->string('alamat');
            $table->string('foto_profil')->nullable();
            $table->string('no_hp');
            $table->string('bukti_usaha');

            // Foreign key UUID ke tabel users
            $table->uuid('id_akun');
            $table->foreign('id_akun')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agens');
    }
};
