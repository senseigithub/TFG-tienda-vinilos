<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoraciones';

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function vinilo() {
        return $this->belongsTo(Vinilo::class);
    }
}
