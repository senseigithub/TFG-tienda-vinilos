<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public function direccionesEnvio() {
        return $this->hasMany(DireccionEnvio::class);
    }

    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }

    public function valoraciones() {
        return $this->hasMany(Valoracion::class);
    }
}
