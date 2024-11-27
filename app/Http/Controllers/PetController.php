<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Client;
use Illuminate\Http\Request;

class PetController extends Controller
{
    // Muestra todos las mascotas
    public function index()
    {
        $pets = Pet::all();
        return response()->json($pets, 200);
    }

    // Crea una nueva mascota
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'medical_conditions' => 'nullable|string',
            'client_id' => 'required|exists:clients,id', // Verifica que el cliente exista
        ]);

        $pet = Pet::create($request->all());

        return response()->json([
            'message' => 'Mascota creada con éxito',
            'data' => $pet,
        ], 201);
    }

    // Muestra una mascota específica
    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        return response()->json($pet, 200);
    }

    // Actualiza los datos de una mascota
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

    // Elimina una mascota
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return response()->json([
            'message' => 'Mascota eliminada con éxito',
        ], 200);
    }
}
