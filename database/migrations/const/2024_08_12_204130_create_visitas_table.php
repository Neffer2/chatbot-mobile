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
            $table->string('foto_pop')->nullable();
            $table->string('pdv_inscrito')->nullable();
            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marca')->onDelete('cascade');
            $table->string('referencias')->nullable();
            $table->string('presentaciones')->nullable();
            $table->integer('num_cajas')->nullable();
            $table->string('foto_factura')->nullable();
            $table->string('foto_precios')->nullable();
            $table->string('valor_factura')->nullable();
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
