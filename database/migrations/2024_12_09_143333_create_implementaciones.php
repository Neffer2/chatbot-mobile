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
        Schema::create('implementaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nro_implementacion')->nullable();
            $table->string('fecha')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('num_pdv')->nullable();
            $table->string('agente')->nullable();
            $table->text('foto_kit')->nullable();
            $table->text('foto_remision')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implementaciones');
    }
};
