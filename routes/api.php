<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\RecursorHumanosController;
use App\Http\Controllers\API\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiResource('productos', ProductoController::class);
//Route::apiResource('empleados', RecursorHumanosController::class);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Operaciones del inventario protegidas
    Route::apiResource('productos', ProductoController::class)->names('api.productos');
});