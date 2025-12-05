<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Funcionalidades que vienen con el modelo
    use HasFactory, Notifiable;

    // Campos que se pueden llenar al crear o actualizar un usuario
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Campos que no se muestran por seguridad (como la contraseña)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Convierte algunos campos a tipos específicos (fechas, contraseñas encriptadas, etc.)
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
