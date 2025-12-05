<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\ClienteController;

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el inicio de sesión (autenticación real)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para el portal de clientes (mantenemos esta por si la necesitas)
Route::get('/portal-cliente', function () {
    return view('portal-cliente');
})->name('portal.cliente');

// Rutas para el portal de profesionales - gestión de casos (CRUD completo)
// Estas rutas usan el controlador de casos y permiten todas las operaciones
// Nota: El middleware 'auth' está comentado temporalmente para facilitar las pruebas
Route::resource('casos', CasoController::class); // ->middleware('auth')

// Ruta para crear clientes desde el modal (solo método store)
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');