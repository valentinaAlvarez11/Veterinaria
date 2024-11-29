<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('specialty')->get();

        return response()->json($services, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:services|max:255',
            'description' => 'nullable|string',
            'specialty_id' => 'required|exists:specialties,id',
            'price' => 'required|numeric',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'specialty_id' => $request->specialty_id,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Servicio creado con éxito',
            'data' => $service,
        ], 201);
    }

    public function show(Service $service)
    {
        return response()->json($service, 200);
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|max:255|unique:services,name,'.$service->id,
            'description' => 'nullable|string',
            'specialty_id' => 'required|exists:specialties,id',
            'price' => 'required|numeric',
        ]);

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'specialty_id' => $request->specialty_id,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Servicio actualizado con éxito',
            'data' => $service,
        ], 200);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json([
            'message' => 'Servicio eliminado correctamente',
        ], 200);
    }

    public function associateSpecialty(Request $request, $serviceId)
    {
        // Validar la entrada
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'name' => 'required|string|max:255',
        ]);

        $service = Service::findOrFail($serviceId);
        $service->specialty_id = $request->specialty_id;
        if ($request->has('name')) {
            $service->name = $request->name;
        }

        $service->save();

        return response()->json([
            'message' => 'Especialidad asociada correctamente al servicio',
            'data' => $service,
        ], 200);
    }
}
