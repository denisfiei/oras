<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $hidden = [
        'activo', 'created_at', 'updated_at',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function permisos()
    {
        return $this->hasMany(Permiso::class);
    }
}
