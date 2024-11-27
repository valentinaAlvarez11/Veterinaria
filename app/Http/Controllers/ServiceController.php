<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Specialty;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Muestra una lista de los servicios disponibles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $services = Service::all(); // Obtiene todos los servicios
        return response()->json($services, 200);
    }

    /**
     * Almacena un nuevo servicio.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:services|max:255',
            'description' => 'nullable|string',
            'specialty_id' => 'required|exists:specialties,id', // Relación con especialidad
            'price' => 'required|numeric', // Aseguramos que el precio sea un número
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

    /**
     * Muestra un servicio específico.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Service $service)
    {
        return response()->json($service, 200);
    }

    /**
     * Actualiza un servicio existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|max:255|unique:services,name,' . $service->id,
            'description' => 'nullable|string',
            'specialty_id' => 'required|exists:specialties,id', // Relación con especialidad
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

    /**
     * Elimina un servicio.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Service $service)
{
    $service->delete();

    return response()->json([
        'message' => 'Servicio eliminado correctamente',
    ], 200); 
    }
}
