<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caso extends Model
{
    // Nombre de la tabla (Laravel lo detecta solo, pero lo ponemos por si acaso)
    protected $table = 'casos';

    // Campos que se pueden llenar al crear o actualizar un caso
    protected $fillable = [
        'codigo_caso',
        'abogado_asignado',
        'tipo_proceso',
        'estado',
        'progreso',
        'fecha_inicio',
        'cliente_id',
        'profesional_id',
    ];

    // Relación: un caso tiene un cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    // Relación: un caso tiene un profesional asignado
    public function profesional(): BelongsTo
    {
        return $this->belongsTo(User::class, 'profesional_id');
    }

    // Genera el siguiente código de caso automáticamente (C-001, C-002, etc.)
    public static function generarCodigoCaso(): string
    {
        // Busca el último caso para ver qué número sigue
        $ultimoCaso = self::orderBy('codigo_caso', 'desc')->first();
        
        if ($ultimoCaso) {
            // Saca el número del código (ej: "C-005" -> 5)
            $numero = (int) substr($ultimoCaso->codigo_caso, 2);
            $nuevoNumero = $numero + 1;
        } else {
            // Si no hay casos, empieza desde el 1
            $nuevoNumero = 1;
        }
        
        // Le pone ceros a la izquierda para que quede C-001, C-002, etc.
        return 'C-' . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);
    }

    // Lista de estados que puede tener un caso
    public static function estadosValidos(): array
    {
        return ['En proceso', 'Completado', 'En revisión', 'Pendiente'];
    }
}
