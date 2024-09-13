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
        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('stock');
            $table->integer('puntos');
            $table->unsignedBigInteger('marca_id');
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('marca_id')->references('id')->on('marca')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premios');
    }
};