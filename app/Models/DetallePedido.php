<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'detalle_pedidos';

    protected $fillable = [
        'pedido_id',
        'vinilo_id',
        'cantidad',
        'precio_unitario',
    ];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }

    public function vinilo() {
        return $this->belongsTo(Vinilo::class);
    }
}

