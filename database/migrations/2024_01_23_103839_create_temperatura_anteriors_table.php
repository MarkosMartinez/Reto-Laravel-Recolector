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
        Schema::create('temperaturas_anteriores', function (Blueprint $table) {
            $table->string('nombre');
            $table->decimal('temperatura', 5, 2);
            $table->timestamp('fecha')->format('yy/MM/dd HH:MM');
            $table->primary(['nombre', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temperaturas_anteriores');
    }
};
