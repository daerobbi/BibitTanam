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
        Schema::create('bibit', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->timestamps();
            $table->string('nama_bibit');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('foto_bibit');

            $table->uuid('id_rekantani');
            $table->uuid('id_jenisbibit');

            $table->foreign('id_rekantani')->references('id')->on('rekan_tanis')->onDelete('cascade');
            $table->foreign('id_jenisbibit')->references('id')->on('jenis_bibits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibit');
    }
};
