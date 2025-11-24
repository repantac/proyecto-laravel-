<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    // Crea un nuevo cliente desde el modal
    public function store(Request $request)
    {
        // Revisa que los datos estén bien
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'Este cliente ya está registrado. Por favor, intente nuevamente.',
        ]);

        // Crea el cliente con una contraseña temporal (el cliente puede cambiarla después)
        $cliente = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('temporal123'), // Contraseña temporal, se puede cambiar después
        ]);

        // Retorna el cliente creado en formato JSON para el JavaScript
        return response()->json([
            'success' => true,
            'cliente' => [
                'id' => $cliente->id,
                'name' => $cliente->name,
                'email' => $cliente->email,
            ],
            'message' => 'Cliente creado exitosamente'
        ]);
    }
}
