<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeputusan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'suratkeputusan';

    // Tentukan atribut yang bisa diisi secara massal
    protected $fillable = [
        'tanggal',
        'waktu',
        'nama_pengajar',
        'mapel',
        'golongan_id',
        'jml_jp',
        'tarif_jp',
        'jumlah_bruto',
    ];

    // Tentukan relasi dengan model Golongan
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }
}
