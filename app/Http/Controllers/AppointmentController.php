<?php

// app/Http/Controllers/AppointmentController.php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with(['client', 'veterinarian'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'veterinarian_id' => 'required|exists:veterinarians,id',
            'appointment_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'appointment_date' => [
                'required',
                'date',
                Rule::unique('appointments')->where(function ($query) use ($request) {
                    return $query->where('veterinarian_id', $request->veterinarian_id)
                                 ->where('appointment_date', $request->appointment_date);
                })
            ]
        ]);
        $appointment = Appointment::create($validated);

        return response()->json($appointment, 201);
    }

    public function show($id)
    {
        return Appointment::with(['client', 'veterinarian'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return response()->json($appointment);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['message' => 'Cita eliminada exitosamente'], 200);
    }
}