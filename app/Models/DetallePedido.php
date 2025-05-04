<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detalles_pedido';

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }

    public function vinilo() {
        return $this->belongsTo(Vinilo::class);
    }
}

