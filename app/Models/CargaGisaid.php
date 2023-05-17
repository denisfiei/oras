<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaGisaid extends Model
{
    use HasFactory;

    protected $fillable = [
        'carga_id',
        'linaje_id',
        'virus_name',
        'accession_id',
        'collection_date',
        'location',
        'host',
        'additional_location_information',
        'sampling_strategy',
        'gender',
        'patient_age',
        'patient_status',
        'last_vaccinated',
        'passage',
        'specimen',
        'additional_host_information',
        'lineage',
        'clade',
        'aa_substitutions',
    ];

    protected $hidden = [
        'activo', 'created_at', 'updated_at',
    ];
}
