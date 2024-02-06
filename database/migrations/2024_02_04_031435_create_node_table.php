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
        Schema::create('node', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jalan')->comment('Nama jalan');
            $table->string('lat')->nullable()->comment('Latitude (data lat spasial dari peta)');
            $table->string('long')->nullable()->comment('Longitude (data long spasial dari peta)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node');
    }
};
