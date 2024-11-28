<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeterinarianUpdateRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Puedes agregar lógica de autorización si es necesario
    }

    /**
     * Obtener las reglas de validación que se aplicarán a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255', // Se asegura que el nombre no sea vacío
            'specialty' => 'required|string|max:255', // Se asegura que la especialidad no sea vacía
            'email' => 'required|string|email|max:255|unique:veterinarians,email,' . $this->route('veterinarian'), // Asegura que el correo sea único, excepto para el veterinario actual
            'phone' => 'nullable|string|max:15', // El teléfono es opcional
        ];
    }
}
