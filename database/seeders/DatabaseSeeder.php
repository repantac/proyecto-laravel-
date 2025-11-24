<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    // Ejecuta todos los seeders para crear datos de prueba
    public function run(): void
    {
        // Crea un usuario de prueba si no existe
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password123'),
            ]
        );

        // Ejecuta el seeder de casos
        $this->call([
            CasoSeeder::class,
        ]);
    }
}
