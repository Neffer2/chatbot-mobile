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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id');
            $table->foreign('pdv_id')->references('id')->on('puntos_venta');
            $table->foreignId('pdv_id');
            $table->string('foto_pdv');
            $table->string('segmento');
            $table->string('punto_inscrito')->nullable();
            $table->string('terpel')->nullable();
            $table->string('mobil')->nullable();
            $table->string('valor_fatura')->nullable();
            $table->string('foto_fatura')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreignId('estado_id');

            $table->foreign('estado_id_agente')->references('id')->on('estados');
            $table->foreignId('estado_id_agente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
