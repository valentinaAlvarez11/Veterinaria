<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pet;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Muestra todos los clientes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Obtener todos los clientes con sus mascotas asociadas
        $clients = Client::with('pets')->get(); // Usamos eager loading

        return response()->json($clients, 200);
    }

    /**
     * Almacena un nuevo cliente.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Crear el cliente
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

    /**
     * Muestra un cliente específico.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client)
    {
        // Cargar las mascotas asociadas al cliente
        $client = Client::with('pets')->findOrFail($client->id);

        return response()->json($client, 200);
    }

    /**
     * Actualiza un cliente existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Client $client)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Actualizar el cliente
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

    /**
     * Elimina un cliente.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'message' => 'Cliente eliminado con éxito',
        ], 200);
    }

    /**
     * Asociar una mascota a un cliente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $clientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPetToClient(Request $request, $clientId)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer',
            'medical_conditions' => 'nullable|string',
        ]);

        // Encontrar al cliente
        $client = Client::findOrFail($clientId);

        // Crear la mascota y asociarla al cliente
        $pet = new Pet([
            'name' => $request->name,
            'breed' => $request->breed,
            'age' => $request->age,
            'medical_conditions' => $request->medical_conditions,
        ]);

        // Asociar la mascota al cliente
        $client->pets()->save($pet);

        // Retornar respuesta
        return response()->json([
            'message' => 'Mascota asociada al cliente con éxito.',
            'data' => $pet,
        ], 201);
    }
}
