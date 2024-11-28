<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Http\Requests\SpecialtyStoreRequest;
use App\Http\Requests\SpecialtyUpdateRequest;
use App\Http\Resources\SpecialtyResource;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = Specialty::orderBy('name', 'asc')->get();
        return response()->json(['data' => SpecialtyResource::collection($specialties)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecialtyStoreRequest $request)
    {
        $specialty = Specialty::create($request->all());
        return response()->json(['data' => $specialty], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty)
    {
        return response()->json(['data' => new SpecialtyResource($specialty)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecialtyUpdateRequest $request, Specialty $specialty)
    {
        $specialty->update($request->all());
        return response()->json(['data' => $specialty], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return response(null, 204);
    }
}
