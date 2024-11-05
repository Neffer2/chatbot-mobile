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
        Schema::create('registro_visitas_mobil', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id');
            $table->foreign('visita_id')->references('id')->on('visitas_mobil');
            $table->foreignId('visita_id');
            $table->foreign('item_meta_id')->references('id')->on('items_metas');
            $table->foreignId('item_meta_id');
            $table->string('puntos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_visitas_mobil');
    }
};
