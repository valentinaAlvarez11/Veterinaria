<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PetController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\ServiceController;
use App\Http\Controllers\api\SpecialtyController;
use App\Http\Controllers\api\VeterinarianController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//CRUDS
Route::apiResource('veterinarians', VeterinarianController::class);
Route::apiResource('specialties', SpecialtyController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('clients', ClientController::class);
Route::apiResource('pets', PetController::class);


//Asociar una especialidad a un servicio
Route::post('/speciality/{specialty}/services', [ServiceController::class, 'associateSpecialty']);
//Asociar una mascota a un cliente
Route::post('/clients/{clientId}/pets', [ClientController::class, 'addPetToClient']);