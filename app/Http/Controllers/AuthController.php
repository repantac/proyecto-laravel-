<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra la página de login
    public function showLoginForm()
    {
        return view('inicio');
    }

    // Procesa el login (revisa usuario y contraseña)
    public function login(Request $request)
    {
        // Revisa que se hayan llenado todos los campos
        $request->validate([
            'usuario' => 'required|string',
            'clave' => 'required|string',
            'tipo_usuario' => 'required|string|in:cliente,profesional',
        ]);

        // Busca el usuario por email o nombre
        $user = User::where('email', $request->usuario)
                    ->orWhere('name', $request->usuario)
                    ->first();

        // Primero verifica si el usuario existe
        if (!$user) {
            return back()->with('error', 'El usuario no existe. Por favor verifique sus datos e intente nuevamente.');
        }

        // Verifica si la contraseña está bien
        if (Hash::check($request->clave, $user->password)) {
            // Inicia la sesión
            Auth::login($user);
            
            // Guarda el nombre en la sesión
            session(['usuario' => $user->name]);
            session(['tipo_usuario' => $request->tipo_usuario]);

            // Lo lleva a su portal según el tipo de usuario
            if ($request->tipo_usuario === 'cliente') {
                return redirect('/portal-cliente');
            } else {
                return redirect()->route('casos.index');
            }
        }

        // Si la contraseña está mal
        return back()->with('error', 'Contraseña incorrecta. Por favor verifique sus datos e intente nuevamente.');
    }

    // Cierra la sesión
    public function logout()
    {
        // Cierra la sesión
        Auth::logout();
        
        // Limpia todo de la sesión
        session()->flush();

        // Lo lleva de vuelta al login
        return redirect('/')->with('success', 'Sesión cerrada exitosamente');
    }
}
