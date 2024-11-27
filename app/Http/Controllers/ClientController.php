<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        $clients = Client::all(); // Obtener todos los clientes
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
}
