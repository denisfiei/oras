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

    public function voi_voc_peru()
    {
        return $this->hasMany(ViewGisaid::class, 'lineage', 'codigo')->where('nivel1', 'Peru');
    }
    public function voi_voc_colombia()
    {
        return $this->hasMany(ViewGisaid::class, 'lineage', 'codigo')->where('nivel1', 'Colombia');
    }
    public function voi_voc_ecuador()
    {
        return $this->hasMany(ViewGisaid::class, 'lineage', 'codigo')->where('nivel1', 'Ecuador');
    }
    public function voi_voc_bolivia()
    {
        return $this->hasMany(ViewGisaid::class, 'lineage', 'codigo')->where('nivel1', 'Bolivia');
    }
}
