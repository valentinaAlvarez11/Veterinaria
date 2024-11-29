<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('veterinarians')->get();

        return response()->json($pets, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'medical_conditions' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
        ]);

        $pet = Pet::create($request->all());

        return response()->json([
            'message' => 'Mascota creada con éxito',
            'data' => $pet,
        ], 201);
    }

    public function show($id)
    {
        $pet = Pet::with('veterinarians')->findOrFail($id);

        return response()->json($pet, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'medical_conditions' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
        ]);

        $pet = Pet::findOrFail($id);
        $pet->update($request->all());

        return response()->json([
            'message' => 'Mascota actualizada con éxito',
            'data' => $pet,
        ], 200);
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return response()->json([
            'message' => 'Mascota eliminada con éxito',
        ], 200);
    }

    public function assignVeterinarians(Request $request, $petId)
    {
        $request->validate([
            'veterinarians' => 'required|array',
            'veterinarians.*' => 'exists:veterinarians,id',
        ]);
        $pet = Pet::findOrFail($petId);
        $pet->veterinarians()->syncWithoutDetaching($request->input('veterinarians'));

        return response()->json([
            'message' => 'Veterinario asignado con éxito a la mascota.',
            'data' => $pet->veterinarians,
        ]);
    }
}
