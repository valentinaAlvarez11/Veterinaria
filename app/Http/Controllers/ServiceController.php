<?php

namespace App\Http\Controllers\api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('specialty')->orderBy('name', 'asc')->get();
        return response()->json(['data' => ServiceResource::collection($services)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service = Service::create($request->all());
        return response()->json(['data' => $service], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json(['data' => new ServiceResource($service)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
        return response()->json(['data' => $service], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response(null, 204);
    }

    /**
     * Associate a specialty to a service.
     */
    public function associateSpecialty(Request $request, $serviceId)
    {
        // Find the service
        $service = Service::findOrFail($serviceId);

        // Associate the specialty to the service
        $service->specialty_id = $request->specialty_id;

        // Optionally update the name if provided
        if ($request->has('name')) {
            $service->name = $request->name;
        }

        // Save the updated service
        $service->save();

        return response()->json([
            'message' => 'Specialty successfully associated with service',
            'data' => $service,
        ], 200);
    }
}
