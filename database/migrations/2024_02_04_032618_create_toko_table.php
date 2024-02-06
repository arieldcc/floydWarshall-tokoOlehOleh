<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('node_id')->comment('ID alamat toko/jalan');
            $table->string('nama_toko')->nullable()->comment('Nama Toko atau objek yang dicari/dituju');
            $table->string('pemilik')->nullable()->comment('Nama Pemilik/owner Toko');
            $table->string('alamat_lengkap')->nullable()->comment('Alamat selain nama jalan');
            $table->string('no_telp')->nullable()->comment('Nomor Telp/WA Toko');
            $table->string('waktu_buka')->nullable()->comment('Waktu buka Toko (hari/jam buka). Misal. Senin-Jumat, Jam 08.00-21.00 WITA');
            $table->string('logo')->nullable()->comment('Logo Toko/tempat');
            $table->string('ket')->nullable()->comment('Keterangan tentang toko');

            $table->foreign('node_id')->references('id')->on('node');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
