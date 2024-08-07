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
            'start_time',
            'end_time',
            'pegawai_id',
            'mata_pelatihan_id',
            'golongan_id',
            'jml_jp',
            'tarif_jp',
            'jumlah_bruto',
            'sub_mata_pelatihan_id',
        ];

        // Tentukan relasi dengan model Golongan
        public function golongan()
        {
            return $this->belongsTo(Golongan::class, 'golongan_id');
        }
        public function mata_pelatihan()
        {
            return $this->belongsTo(MataPelatihan::class, 'mata_pelatihan_id');
        }
        public function pegawai()
        {
            return $this->belongsTo(Pegawai::class, 'pegawai_id');
        }

        public function sub_mata_pelatihan()
        {
            return $this->belongsTo(SubMataPelatihan::class, 'sub_mata_pelatihan_id');
        }

    }
