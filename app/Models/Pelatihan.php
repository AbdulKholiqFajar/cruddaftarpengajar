<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Pelatihan extends Model
    {
        use HasFactory;

        protected $table = 'pelatihan';

        protected $fillable = [
            'title',
            'tanggal',
            'start_time',
            'end_time',
            'pengajar_id',
            'mata_pelatihan_id',
            'golongan_id',
            'jml_jp',
            'tarif_jp',
            'jumlah_bruto',
            'approve',
        ];

        public function golongan()
        {
            return $this->belongsTo(Golongan::class, 'golongan_id', 'nama');
        }
        public function mata_pelatihan()
        {
            return $this->belongsTo(MataPelatihan::class, 'mata_pelatihan_id');
        }
        public function pengajar()
        {
            return $this->belongsTo(Pengajar::class, 'pengajar_id');
        }
    }
