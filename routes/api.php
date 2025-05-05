<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ViniloController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\DireccionEnvioController;
use App\Http\Controllers\Api\DetallePedidoController;
use App\Http\Controllers\Api\ValoracionController;
use App\Http\Controllers\Api\UsuarioController;

// Ruta de prueba básica
Route::get('/ping', function () {
    return response()->json(['message' => 'API funcionando ✅']);
});

Route::apiResource('vinilos', ViniloController::class);
Route::apiResource('proveedores', ProveedorController::class);
Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('direcciones-envio', DireccionEnvioController::class);
Route::apiResource('detalles-pedido', DetallePedidoController::class);
Route::apiResource('valoraciones', ValoracionController::class);
Route::apiResource('usuarios', UsuarioController::class);
