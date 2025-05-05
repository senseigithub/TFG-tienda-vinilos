<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionEnvio extends Model
{
    protected $table = 'direcciones_envio';

    protected $fillable = [
        'usuario_id',
        'direccion',
        'ciudad',
        'codigo_postal',
        'telefono',
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }
}
