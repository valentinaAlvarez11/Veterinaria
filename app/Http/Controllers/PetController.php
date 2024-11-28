<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Http\Requests\PetStoreRequest;
use App\Http\Requests\PetUpdateRequest;
use App\Http\Resources\PetResource;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::all();
        return response()->json(['data' => PetResource::collection($pets)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PetStoreRequest $request)
    {
        $pet = Pet::create($request->all());
        return response()->json(['data' => $pet], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        return response()->json(['data' => new PetResource($pet)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PetUpdateRequest $request, $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update($request->all());
        return response()->json(['data' => $pet], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        return response(null, 204);
    }
}
