<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // Crear una nueva consulta
    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'veterinarian_id' => 'required|exists:veterinarians,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $consultation = Consultation::create($request->all());

        return response()->json([
            'message' => 'Consulta registrada con éxito',
            'data' => $consultation,
        ], 201);
    }

    public function index()
    {
        $consultations = Consultation::with(['pet', 'veterinarian'])->get();

        return response()->json($consultations, 200);
    }

    public function show($id)
    {
        $consultation = Consultation::with(['pet', 'veterinarian'])->findOrFail($id);

        return response()->json($consultation, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pet_id' => 'sometimes|exists:pets,id',
            'veterinarian_id' => 'sometimes|exists:veterinarians,id',
            'diagnosis' => 'sometimes|string',
            'treatment' => 'sometimes|string',
            'notes' => 'nullable|string',
        ]);

        $consultation = Consultation::findOrFail($id);
        $consultation->update($request->all());

        return response()->json([
            'message' => 'Consulta actualizada con éxito',
            'data' => $consultation,
        ], 200);
    }

    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();

        return response()->json([
            'message' => 'Consulta eliminada con éxito',
        ], 200);
    }

    public function getByPet($petId)
    {
        $consultations = Consultation::with('veterinarian')
            ->where('pet_id', $petId)
            ->get();

        return response()->json($consultations, 200);
    }
}
