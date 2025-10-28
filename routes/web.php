<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Ruta 1: para mostrar el formulario de inicio de sesión
Route::get('/', function () {
    return view('inicio');
});

// Ruta 2: para procesar el inicio de sesión
Route::post('/login', function (Request $request) {
    // Validar el usuario, la clave y el tipo de usuario
    $usuario = $request->input('usuario');
    $clave = $request->input('clave');
    $tipo_usuario = $request->input('tipo_usuario');

    if (!empty($usuario) && !empty($clave) && !empty($tipo_usuario)) {
        // Si el usuario es válido, redirigir según el tipo de usuario
        if ($tipo_usuario === 'cliente') {
            return redirect('/portal-cliente')->with('usuario', $usuario);
        } elseif ($tipo_usuario === 'profesional') {
            return redirect('/portal-profesional')->with('usuario', $usuario);
        }
    } else {
        // Si el usuario no es válido, volver a mostrar el formulario con un mensaje de error
        return back()->with('error', 'Por favor complete todos los campos');
    }
});

// Ruta 3: para el portal de clientes
Route::get('/portal-cliente', function () {
    return view('portal-cliente');
});

// Ruta 4: para el portal de profesionales
Route::get('/portal-profesional', function () {
    return view('portal-profesional');
});