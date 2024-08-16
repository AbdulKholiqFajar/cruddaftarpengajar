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
        'tentang',
        'menimbang',
        'mengingat',
        'memperhatikan',
        'menetapkan',
        'tembusan',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($sk) {
            // Generate the next nomor_sk
            $latestSK = self::latest('created_at')->first();
            $latestNumber = $latestSK ? intval(explode('/', $latestSK->nomor_sk)[0]) : 0;
            $nextNumber = $latestNumber + 1;
            $sk->nomor_sk = $nextNumber . '/KPTS-SATKER/Mm/' . date('Y');
        });
    }

    protected $casts = [
        'tanggal_sk' => 'date', // Cast tanggal_sk ke format date
    ];

    // Jika Anda menggunakan soft deletes
    protected $dates = ['deleted_at'];

    // Jika Anda ingin menambahkan fungsi-fungsi tambahan atau relasi, tambahkan di sini
}
