<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pet;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {

        $clients = Client::with('pets')->get();

        return response()->json($clients, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'Cliente creado con éxito',
            'data' => $client,
        ], 201);
    }

    public function show(Client $client)
    {
        $client = Client::with('pets')->findOrFail($client->id);

        return response()->json($client, 200);
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,'.$client->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return response()->json([
            'message' => 'Cliente actualizado con éxito',
            'data' => $client,
        ], 200);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'message' => 'Cliente eliminado con éxito',
        ], 200);
    }

    public function addPetToClient(Request $request, $clientId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'medical_conditions' => 'nullable|string',
        ]);

        $client = Client::findOrFail($clientId);

        $pet = new Pet([
            'name' => $request->name,
            'breed' => $request->breed,
            'age' => $request->age,
            'medical_conditions' => $request->medical_conditions,
        ]);

        $client->pets()->save($pet);

        return response()->json([
            'message' => 'Mascota asociada al cliente con éxito.',
            'data' => $pet,
        ], 201);
    }
}
