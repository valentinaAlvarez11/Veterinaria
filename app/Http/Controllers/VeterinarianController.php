<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use App\Http\Requests\VeterinarianStoreRequest;
use App\Http\Requests\VeterinarianUpdateRequest;
use App\Http\Resources\VeterinarianResource;

class VeterinarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $veterinarians = Veterinarian::orderBy('name', 'asc')->get();
        return response()->json(['data' => VeterinarianResource::collection($veterinarians)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $veterinarian = Veterinarian::create($request->all());
        return response()->json(['data' => $veterinarian], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Veterinarian $veterinarian)
    {
        return response()->json(['data' => new VeterinarianResource($veterinarian)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Veterinarian $veterinarian)
    {
        $veterinarian->update($request->all());
        return response()->json(['data' => $veterinarian], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Veterinarian $veterinarian)
    {
        $veterinarian->delete();
        return response(null, 204);
    }
}
