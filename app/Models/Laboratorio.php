<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;

    protected $hidden = [
        'activo', 'created_at', 'updated_at',
    ];

    public function pais()
    {
        return $this->hasOne(Pais::class, 'id', 'pais_id')->select('id', 'nombre', 'bandera');
    }
}
