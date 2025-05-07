<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ViniloController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\DireccionEnvioController;
use App\Http\Controllers\Api\DetallePedidoController;
use App\Http\Controllers\Api\ValoracionController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\AuthController;


// Ruta de prueba básica
Route::get('/ping', function () {
    return response()->json(['message' => 'API funcionando ✅']);
});

// Login y registro (sin token)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {

    // Info del usuario autenticado
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Para todos los usuarios autenticados
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('direcciones-envio', DireccionEnvioController::class);
    Route::apiResource('pedidos', PedidoController::class);
    Route::apiResource('detalles-pedido', DetallePedidoController::class);
    Route::apiResource('valoraciones', ValoracionController::class);

    // Solo admins
    Route::middleware('is_admin')->group(function () {
        Route::apiResource('vinilos', ViniloController::class);
        Route::apiResource('proveedores', ProveedorController::class);
    });
});
