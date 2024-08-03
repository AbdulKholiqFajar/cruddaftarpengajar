<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMataPelatihan extends Model
{
    use HasFactory;

    protected $table = 'sub_mata_pelatihans';

    protected $fillable = [
        'code_sub_mata_pelatihan', 
        'mata_pelatihan_id',
        'sub_mata_pelatihan',
    ];

    public function mata_pelatihan()
    {
        return $this->belongsTo(MataPelatihan::class, 'mata_pelatihan_id');
    }
    
}
