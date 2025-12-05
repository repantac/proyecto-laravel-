<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Ejecuta la migración: crea la tabla de postulaciones en la base de datos
    public function up(): void
    {
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    // Revierte la migración: elimina la tabla si es necesario
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
