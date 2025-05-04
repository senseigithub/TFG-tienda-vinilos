<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DireccionEnvio extends Model
{
    protected $table = 'direcciones_envio';

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }
}
