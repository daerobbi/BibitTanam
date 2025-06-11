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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->uuid('id')->primary(); // pakai UUID agar konsisten
            $table->timestamps();
            $table->integer('jumlah_permintaan');
            $table->date('tanggal_dibutuhkan');
            $table->date('tanggal_pengiriman')->nullable();
            $table->string('lokasi_pengiriman');
            $table->string('keterangan')->nullable();
            $table->string('narahubung');
            $table->boolean('status_pengajuan')->nullable();
            $table->boolean('status_pembayaran')->nullable();
            $table->enum('status_pengiriman',['diproses','dikirim','selesai']);
            $table->string('foto_invoice')->nullable();
            $table->string('bukti_bayar')->nullable();

            // foreign key id_bibit tanpa onDelete cascade
            $table->uuid('id_bibit');
            $table->foreign('id_bibit')->references('id')->on('bibit');

            // foreign key id_agens dengan onDelete cascade
            $table->uuid('id_agens');
            $table->foreign('id_agens')->references('id')->on('agens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
