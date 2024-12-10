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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('documento')->unique();
            $table->string('telefono')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreignId('empresa_id');
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreignId('rol_id');
            $table->integer('puntos')->default(0);
            $table->integer('meta_pdv');
            $table->text('BI')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
