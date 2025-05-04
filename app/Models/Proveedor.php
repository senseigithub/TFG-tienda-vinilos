<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    public function vinilos() {
        return $this->hasMany(Vinilo::class);
    }
}

