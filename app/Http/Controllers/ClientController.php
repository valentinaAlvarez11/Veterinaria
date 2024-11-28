<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Pet;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Requests\PetStoreRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\PetResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('pets')->get();
        return response()->json(['data' => ClientResource::collection($clients)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->all());
        return response()->json(['data' => new ClientResource($client)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client = Client::with('pets')->findOrFail($client->id);
        return response()->json(['data' => new ClientResource($client)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->all());
        return response()->json(['data' => new ClientResource($client)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }

    /**
     * Associate a pet to a client.
     */
    public function addPetToClient(PetStoreRequest $request, $clientId)
    {
        $client = Client::findOrFail($clientId);

        $pet = new Pet($request->all());
        $client->pets()->save($pet);

        return response()->json([
            'message' => 'Mascota asociada al cliente con éxito.',
            'data' => new PetResource($pet),
        ], 201);
    }
}
