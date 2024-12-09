<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//CRUDS
Route::apiResource('veterinarians', VeterinarianController::class);
Route::apiResource('specialties', SpecialtyController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('clients', ClientController::class);
Route::apiResource('pets', PetController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('consultations', ConsultationController::class);
Route::apiResource('users', UserController::class);

//Asociar una especialidad a un servicio speciality
Route::post('/services/{specialty}/speciality', [ServiceController::class, 'associateSpecialty']);
//Asociar una mascota a un cliente
Route::post('/clients/{clientId}/pets', [ClientController::class, 'addPetToClient']);
//Asociar una especialidad y un servicio a un veterinario
Route::post('veterinarians/{veterinarian}/services', [VeterinarianController::class, 'attachService']);
//Asignar una cita a un veterinario
Route::post('veterinarians/{id}/appointments', [AppointmentController::class, 'assignToVeterinarian']);
//Asignar un veterinario a una mascota
Route::post('pet/{petId}/veterinarians', [PetController::class, 'assignVeterinarians']);
//Consultar y crear disponibilidad de los veterinarios
Route::get('availabilities', [AvailabilityController::class, 'getAvailability']);
Route::post('availabilities', [AvailabilityController::class, 'createAvailability']);
//Consultar historial de citas de un cliente
Route::get('clients/{clientId}/appointments', [AppointmentController::class, 'getClientAppointments']);

//Autenticación
Route::post('/v1/login',
    [App\Http\Controllers\api\v1\AuthController::class,
        'login'])->name('api.login');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/v1/logout',
        [App\Http\Controllers\api\v1\AuthController::class,
            'logout'])->name('api.logout');
});
