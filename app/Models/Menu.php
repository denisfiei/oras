<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function permiso()
    {
        return $this->hasOne(Permiso::class, 'menu_id', 'id');
    }
}
