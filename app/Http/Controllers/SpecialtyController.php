<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Muestra una lista de especialidades.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $specialties = Specialty::all(); // Obtiene todas las especialidades
        return response()->json($specialties, 200);
    }

    /**
     * Almacena una nueva especialidad.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specialties|max:255',
            'description' => 'nullable|string',
        ]);

        $specialty = Specialty::create($request->all());
        return response()->json([
            'message' => 'Especialidad creada con éxito',
            'data' => $specialty,
        ], 201);
    }

    /**
     * Muestra una especialidad específica.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Specialty $specialty)
    {
        return response()->json($specialty, 200);
    }

    /**
     * Actualiza una especialidad existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|max:255|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable|string',
        ]);

        $specialty->update($request->all());
        return response()->json([
            'message' => 'Especialidad actualizada con éxito',
            'data' => $specialty,
        ], 200);
    }

    /**
     * Elimina una especialidad.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return response()->json([
            'message' => 'Especialidad eliminada con éxito',
        ], 200);
    }
}
