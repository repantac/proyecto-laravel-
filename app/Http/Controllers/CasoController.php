<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CasoController extends Controller
{
    // Muestra la lista de casos del profesional que está logueado
    public function index()
    {
        // Solo trae los casos de este profesional, los más nuevos primero
        // Usa created_at como criterio principal y id como secundario para mantener consistencia
        $casos = Caso::where('profesional_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc')
                    ->get();
        
        // Muestra la vista con los casos
        return view('portal-profesional', compact('casos'));
    }

    // Muestra el formulario para crear un caso nuevo
    public function create()
    {
        // Muestra la vista del formulario
        return view('casos.create');
    }

    // Guarda un caso nuevo en la base de datos
    public function store(Request $request)
    {
        // Genera el código del caso automáticamente
        $codigoCaso = Caso::generarCodigoCaso();

        // Revisa que los datos estén bien
        $request->validate([
            'abogado_asignado' => 'required|string|max:100',
            'tipo_proceso' => 'required|string|max:50',
            'estado' => 'required|string|in:En proceso,Completado,En revisión,Pendiente',
            'progreso' => 'required|integer|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'cliente_id' => 'required|exists:users,id',
        ], [
            'abogado_asignado.required' => 'El campo abogado asignado es obligatorio.',
            'tipo_proceso.required' => 'El campo tipo de proceso es obligatorio.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
            'progreso.required' => 'El campo progreso es obligatorio.',
            'progreso.integer' => 'El progreso debe ser un número entero.',
            'progreso.min' => 'El progreso no puede ser menor a 0.',
            'progreso.max' => 'El progreso no puede ser mayor a 100.',
            'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio.',
            'fecha_inicio.date' => 'La fecha de inicio no es válida.',
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
        ]);

        // Crea el caso nuevo con todos los datos
        Caso::create([
            'codigo_caso' => $codigoCaso,
            'abogado_asignado' => $request->abogado_asignado,
            'tipo_proceso' => $request->tipo_proceso,
            'estado' => $request->estado,
            'progreso' => $request->progreso,
            'fecha_inicio' => $request->fecha_inicio,
            'cliente_id' => $request->cliente_id,
            'profesional_id' => Auth::id(), // Le asigna el caso al profesional que está logueado
        ]);

        // Vuelve a la lista y muestra un mensaje de que se creó bien
        return redirect()->route('casos.index')->with('success', 'Caso creado exitosamente');
    }

    // Muestra los detalles de un caso
    public function show(string $id)
    {
        // Busca el caso y verifica que sea del profesional logueado
        $caso = Caso::where('id', $id)
                    ->where('profesional_id', Auth::id())
                    ->firstOrFail();
        
        // Muestra la vista con los detalles
        return view('casos.show', compact('caso'));
    }

    // Muestra el formulario para editar un caso
    public function edit(string $id)
    {
        // Busca el caso y verifica que sea del profesional logueado
        $caso = Caso::where('id', $id)
                    ->where('profesional_id', Auth::id())
                    ->firstOrFail();
        
        // Muestra la vista del formulario de edición
        return view('casos.edit', compact('caso'));
    }

    // Actualiza un caso existente
    public function update(Request $request, string $id)
    {
        // Busca el caso y verifica que sea del profesional logueado
        $caso = Caso::where('id', $id)
                    ->where('profesional_id', Auth::id())
                    ->firstOrFail();

        // Revisa que los datos estén bien (sin el código porque no se puede cambiar)
        $request->validate([
            'abogado_asignado' => 'required|string|max:100',
            'tipo_proceso' => 'required|string|max:50',
            'estado' => 'required|string|in:En proceso,Completado,En revisión,Pendiente',
            'progreso' => 'required|integer|min:0|max:100',
            'fecha_inicio' => 'required|date',
            'cliente_id' => 'required|exists:users,id',
        ], [
            'abogado_asignado.required' => 'El campo abogado asignado es obligatorio.',
            'tipo_proceso.required' => 'El campo tipo de proceso es obligatorio.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
            'progreso.required' => 'El campo progreso es obligatorio.',
            'progreso.integer' => 'El progreso debe ser un número entero.',
            'progreso.min' => 'El progreso no puede ser menor a 0.',
            'progreso.max' => 'El progreso no puede ser mayor a 100.',
            'fecha_inicio.required' => 'El campo fecha de inicio es obligatorio.',
            'fecha_inicio.date' => 'La fecha de inicio no es válida.',
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
        ]);

        // Actualiza el caso con los nuevos datos (el código no se toca)
        $caso->update([
            'abogado_asignado' => $request->abogado_asignado,
            'tipo_proceso' => $request->tipo_proceso,
            'estado' => $request->estado,
            'progreso' => $request->progreso,
            'fecha_inicio' => $request->fecha_inicio,
            'cliente_id' => $request->cliente_id,
        ]);

        // Vuelve a la lista y muestra un mensaje de que se actualizó bien
        return redirect()->route('casos.index')->with('success', 'Caso actualizado exitosamente');
    }

    // Elimina un caso de la base de datos
    public function destroy(string $id)
    {
        // Busca el caso y verifica que sea del profesional logueado
        $caso = Caso::where('id', $id)
                    ->where('profesional_id', Auth::id())
                    ->firstOrFail();
        
        // Borra el caso
        $caso->delete();

        // Vuelve a la lista y muestra un mensaje de que se eliminó bien
        return redirect()->route('casos.index')->with('success', 'Caso eliminado exitosamente');
    }
}
