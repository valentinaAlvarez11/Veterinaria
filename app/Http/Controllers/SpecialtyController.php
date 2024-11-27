<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        return response()->json(Specialty::with('services')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specialties|max:255',
            'description' => 'nullable',
        ]);

        $specialty = Specialty::create($request->all());
        return response()->json($specialty, 201);
    }

    public function show(Specialty $specialty)
    {
        return response()->json($specialty->load('services'));
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'name' => 'required|max:255|unique:specialties,name,' . $specialty->id,
            'description' => 'nullable',
        ]);

        $specialty->update($request->all());
        return response()->json($specialty);
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return response()->json(null, 204);
    }
}
