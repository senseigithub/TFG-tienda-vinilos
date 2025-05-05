<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vinilo extends Model
{
    protected $table = 'vinilos';

    protected $fillable = [
        'proveedor_id',
        'titulo',
        'artista',
        'genero',
        'precio',
        'stock',
        'descripcion',
        'imagen',
    ];

    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalles() {
        return $this->hasMany(DetallePedido::class);
    }

    public function valoraciones() {
        return $this->hasMany(Valoracion::class);
    }
}

