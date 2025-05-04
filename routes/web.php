<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ViniloController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DireccionEnvioController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\ValoracionController;

Route::view('/', 'index')->name('home');

Route::resource('usuarios', UsuarioController::class);
Route::resource('vinilos', ViniloController::class);
Route::resource('proveedores', ProveedorController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('direcciones-envio', DireccionEnvioController::class);
Route::resource('detalles-pedido', DetallePedidoController::class);
Route::resource('valoraciones', ValoracionController::class);



