<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Agrega el campo profesional_id a la tabla casos
    public function up(): void
    {
        Schema::table('casos', function (Blueprint $table) {
            // ID del profesional que tiene el caso (se relaciona con la tabla users)
            $table->foreignId('profesional_id')->nullable()->after('cliente_id')->constrained('users')->onDelete('cascade');
        });
    }

    // Si hay que revertir, quita el campo
    public function down(): void
    {
        Schema::table('casos', function (Blueprint $table) {
            $table->dropForeign(['profesional_id']);
            $table->dropColumn('profesional_id');
        });
    }
};
