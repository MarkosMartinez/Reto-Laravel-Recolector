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
        Schema::create('temperaturas_actuales', function (Blueprint $table) {
            $table->string('nombre')->primary();
            $table->decimal('temperatura', 5, 2);
            $table->decimal('temperatura_real', 5, 2);
            $table->decimal('sensacion_termica', 5, 2);
            $table->integer('humedad');
            $table->string('tiempo')->nullable();
            $table->decimal('viento');
            $table->decimal('presion');
            $table->float('latitud', 8, 6);
            $table->float('longitud', 9, 6);
            $table->timestamp('ultima_actualizacion')->useCurrent();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temperaturas_actuales');
    }
};
