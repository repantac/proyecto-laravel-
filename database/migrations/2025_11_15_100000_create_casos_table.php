<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla de casos
    public function up(): void
    {
        Schema::create('casos', function (Blueprint $table) {
            // ID que Laravel crea solo
            $table->id();
            
            // Código del caso (C-001, C-002, etc.)
            $table->string('codigo_caso', 20)->unique();
            
            // Nombre del abogado que tiene el caso
            $table->string('abogado_asignado', 100);
            
            // Tipo de proceso (Divorcio, Contrato, Herencia, etc.)
            $table->string('tipo_proceso', 50);
            
            // Estado del caso (En proceso, Completado, En revisión, Pendiente)
            $table->string('estado', 30);
            
            // Progreso del caso de 0 a 100
            $table->integer('progreso')->default(0);
            
            // Fecha en que empezó el caso
            $table->date('fecha_inicio');
            
            // ID del cliente (se relaciona con la tabla users)
            $table->foreignId('cliente_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Fechas que Laravel maneja solo
            $table->timestamps();
        });
    }

    // Si hay que revertir, borra la tabla
    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};
