<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoraciones';

    protected $fillable = [
        'usuario_id',
        'vinilo_id',
        'comentario',
        'fecha_valoracion',
    ];

    // app/Models/Valoracion.php
public function getRouteKeyName()
{
    return 'id';
}


    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function vinilo() {
        return $this->belongsTo(Vinilo::class);
    }
}
