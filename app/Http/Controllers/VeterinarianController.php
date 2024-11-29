<?php

namespace App\Http\Controllers;

use App\Models\Veterinarian;
use Illuminate\Http\Request;

class VeterinarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Veterinarian::with(['services.specialty', 'appointments'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $veterinarian = Veterinarian::create($request->all());

        return response()->json($veterinarian, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Veterinarian $veterinarian)
    {
        $veterinarian->load('services.specialty');
        return response()->json($veterinarian, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veterinarian $veterinarian)
    {
        $veterinarian->update($request->all());

        return response()->json($veterinarian, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veterinarian $veterinarian)
    {
        $veterinarian->delete();

        return response()->json(['message' => 'Veterinarian deleted'], 200);
    }

    public function attachService(Request $request, $veterinarianId)
    {
        $request->validate([
            'services' => 'required|array',
            'services.*' => 'exists:services,id'
        ]);
        $veterinarian = Veterinarian::findOrFail($veterinarianId);
        $veterinarian->services()->syncWithoutDetaching($request->input('services'));

        return response()->json([
            'message' => 'Servicios asociados con éxito',
            'data' => $veterinarian->services
        ]);
    }
}
