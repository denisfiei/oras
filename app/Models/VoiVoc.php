<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiVoc extends Model
{
    use HasFactory;

    protected $table = 'voi_voc';

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function voi_voc_casos()
    {
        return $this->hasMany(ViewGisaid::class, 'lineage', 'codigo');
    }
}
