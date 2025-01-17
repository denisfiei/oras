<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virus extends Model
{
    use HasFactory;

    protected $table = 'virus';

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
