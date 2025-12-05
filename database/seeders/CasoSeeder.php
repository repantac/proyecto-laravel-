<?php

namespace Database\Seeders;

use App\Models\Caso;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CasoSeeder extends Seeder
{
    // Crea casos de prueba para poder probar la aplicación
    public function run(): void
    {
        // Busca un usuario para usarlo como cliente, si no hay lo crea
        $cliente = User::first();
        
        if (!$cliente) {
            $cliente = User::create([
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'password' => bcrypt('password123'),
            ]);
        }

        // Busca el profesional de prueba, si no existe lo crea
        $profesional = User::where('email', 'profesional@test.com')->first();
        
        if (!$profesional) {
            $profesional = User::create([
                'name' => 'Profesional Test',
                'email' => 'profesional@test.com',
                'password' => bcrypt('123456'),
            ]);
        }

        // Lista de casos de prueba para crear
        $casos = [
            [
                'codigo_caso' => 'C-001',
                'abogado_asignado' => 'Dr. María González',
                'tipo_proceso' => 'Divorcio',
                'estado' => 'En proceso',
                'progreso' => 50,
                'fecha_inicio' => Carbon::parse('2025-10-15'),
                'cliente_id' => $cliente->id,
                'profesional_id' => $profesional->id,
            ],
            [
                'codigo_caso' => 'C-002',
                'abogado_asignado' => 'Dr. Carlos Ruiz',
                'tipo_proceso' => 'Contrato de Compraventa',
                'estado' => 'Completado',
                'progreso' => 100,
                'fecha_inicio' => Carbon::parse('2025-10-10'),
                'cliente_id' => $cliente->id,
                'profesional_id' => $profesional->id,
            ],
            [
                'codigo_caso' => 'C-003',
                'abogado_asignado' => 'Dr. Laura Torres',
                'tipo_proceso' => 'Herencia',
                'estado' => 'En revisión',
                'progreso' => 75,
                'fecha_inicio' => Carbon::parse('2025-10-20'),
                'cliente_id' => $cliente->id,
                'profesional_id' => $profesional->id,
            ],
        ];

        // Crea cada caso en la base de datos
        foreach ($casos as $caso) {
            Caso::create($caso);
        }
    }
}
