<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelatihan extends Model
{
    use HasFactory;

    protected $table = 'mata_pelatihans';

    protected $fillable = [
        'mata_pelatihan',
        'jml_jp',
    ];

}
