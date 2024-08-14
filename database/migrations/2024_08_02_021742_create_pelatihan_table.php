<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->date('tanggal'); // Kolom tanggal
            $table->time('start_time'); // Kolom waktu
            $table->time('end_time'); // Kolom waktu
            $table->foreignId('pengajar_id')->constrained('pengajar')->onDelete('cascade');
            $table->foreignId('mata_pelatihan_id')->constrained('mata_pelatihans')->onDelete('cascade');
            $table->foreignId('golongan_id')->constrained('golongan')->onDelete('cascade');
            $table->decimal('jml_jp', 10, 2); // Kolom jml_jp
            $table->decimal('tarif_jp', 10, 2); // Kolom tarif_jp
            $table->decimal('jumlah_bruto', 15, 2); // Kolom jumlah_bruto
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelatihan');
    }
}