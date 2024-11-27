<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ClientController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//CRUDS
Route::apiResource('veterinarians', VeterinarianController::class);
Route::apiResource('specialties', SpecialtyController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('clients', ClientController::class);

//Asociar una especialidad a un servicio
Route::post('/speciality/{specialty}/services', [ServiceController::class, 'associateSpecialty']);

