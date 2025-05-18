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

// ✅ Público: ver vinilos
Route::apiResource('vinilos', ViniloController::class)->only(['index', 'show']);

// 🔐 Protegidas
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('direcciones-envio', DireccionEnvioController::class);
    Route::apiResource('pedidos', PedidoController::class);
    Route::apiResource('detalles-pedido', DetallePedidoController::class);
    Route::apiResource('valoraciones', ValoracionController::class);

    Route::middleware('is_admin')->group(function () {
        Route::apiResource('vinilos', ViniloController::class)->except(['index', 'show']);
        Route::apiResource('proveedores', ProveedorController::class);
    });
});

