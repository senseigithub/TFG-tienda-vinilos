<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function direccionEnvio() {
        return $this->belongsTo(DireccionEnvio::class);
    }

    public function detalles() {
        return $this->hasMany(DetallePedido::class);
    }
}

