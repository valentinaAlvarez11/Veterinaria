<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\ServiceController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('veterinarians', VeterinarianController::class);
Route::apiResource('specialties', SpecialtyController::class);
Route::apiResource('services', ServiceController::class);
