<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
 
    public function getAvailability(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required|string',
        ]);

        $dayOfWeek = $request->input('day_of_week');

        $availabilities = Availability::with('veterinarian')
            ->where('day_of_week', $dayOfWeek)
            ->get();

        return response()->json($availabilities, 200);
    }

    public function createAvailability(Request $request)
    {
        $request->validate([
            'veterinarian_id' => 'required|exists:veterinarians,id',
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $availability = Availability::create($request->all());

        return response()->json([
            'message' => 'Disponibilidad creada con éxito',
            'data' => $availability,
        ], 201);
    }
}

