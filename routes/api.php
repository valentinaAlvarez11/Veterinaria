<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AppointmentController;



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

//Asociar una especialidad a un servicio
Route::post('/speciality/{specialty}/services', [ServiceController::class, 'associateSpecialty']);
//Asociar una mascota a un cliente
Route::post('/clients/{clientId}/pets', [ClientController::class, 'addPetToClient']);
//Asociar una especialidad y un servicio a un veterinario
Route::post('/veterinarians/{id}/services', [VeterinarianController::class, 'addServiceToVeterinarian']);

//Autenticación
Route::post('/v1/login',
    [App\Http\Controllers\api\v1\AuthController::class,
        'login'])->name('api.login');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/v1/logout',
        [App\Http\Controllers\api\v1\AuthController::class,
            'logout'])->name('api.logout');
        });
