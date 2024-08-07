<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'nama_pengajar',
        'jabatan',
        'golongan_id',
        'honor',
        'pajak',
        'alamat',
    ];

    protected $dates = [
        // 'tanggal_lahir',
    ];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    public function suratKeputusan()
    {
        return $this->hasOne(SuratKeputusan::class, 'nama_pengajar', 'nama_pengajar');
    }
    
}
