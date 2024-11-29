<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();

        return response()->json($specialties, 200);
    }

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

    public function show(Specialty $specialty)
    {
        return response()->json($specialty, 200);
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|max:255|unique:specialties,name,'.$specialty->id,
            'description' => 'nullable|string',
        ]);

        $specialty->update($request->all());

        return response()->json([
            'message' => 'Especialidad actualizada con éxito',
            'data' => $specialty,
        ], 200);
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();

        return response()->json([
            'message' => 'Especialidad eliminada con éxito',
        ], 200);
    }
}
