<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'dnie',
        'email',
        'password',
        'telefono',
        'rol',
        'carrito',
    ];

    protected $hidden = ['password'];

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
