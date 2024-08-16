<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $table = 'pengajar';

    protected $fillable = [
        'nip',
        'nama_pengajar',
        'jabatan',
        'golongan_id',
        'honor',
        'alamat',
    ];

    protected $dates = [
        // 'tanggal_lahir',
    ];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class, 'pengajar_id');
    }
}
