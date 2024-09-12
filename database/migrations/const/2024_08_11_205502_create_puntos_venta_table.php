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
        Schema::create('puntos_venta', function (Blueprint $table) {
            $table->id();
            $table->string('num_pdv')->unique();
            $table->string('agente');
            $table->string('descripcion');
            $table->string('nit');
            $table->string('direccion');
            $table->string('barrio');
            $table->string('localidad');
            $table->string('segmento_pdv');
            $table->float('vol_prom_mes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntos_venta');
    }
};