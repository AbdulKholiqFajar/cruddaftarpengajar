<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    use HasFactory;

    protected $table = 'sk';

    protected $fillable = [
        'nomor_sk',
        'tanggal_sk',
        'tahun',
        'tentang',
        'menimbang',
        'mengingat',
        'menetapkan',
        'tembusan',
        'isi'
    ];

    protected $casts = [
        'tanggal_sk' => 'date', // Cast tanggal_sk ke format date
    ];

    // Jika Anda menggunakan soft deletes
    protected $dates = ['deleted_at'];

    // Jika Anda ingin menambahkan fungsi-fungsi tambahan atau relasi, tambahkan di sini
}
