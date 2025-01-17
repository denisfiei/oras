<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    use HasFactory;

    protected $hidden = [
        'user_id', 'updated_at',
    ];

    public function virus()
    {
        return $this->hasOne(Virus::class, 'id', 'virus_id')->select('id', 'nombre');
    }
    
    public function pais()
    {
        return $this->hasOne(Pais::class, 'id', 'pais_id')->select('id', 'nombre', 'bandera');
    }
}
