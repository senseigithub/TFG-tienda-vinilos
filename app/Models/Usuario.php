<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

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
