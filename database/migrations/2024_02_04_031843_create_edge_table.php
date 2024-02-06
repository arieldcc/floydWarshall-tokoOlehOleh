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
        Schema::create('edge', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('awal_id')->comment('ID Jalan awal/titik awal');
            $table->unsignedBigInteger('akhir_id')->comment('ID jalan titik akhir/tujuan');
            $table->string('weight')->comment('representasi jarak atau biaya antar dua node');
            $table->string('time')->comment('representasi waktu tempuh antar dua node');

            $table->foreign('awal_id')->references('id')->on('node');
            $table->foreign('akhir_id')->references('id')->on('node');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edge');
    }
};
