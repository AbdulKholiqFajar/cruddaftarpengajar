<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratkeputusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratkeputusan', function (Blueprint $table) {
            $table->id(); // AUTO_INCREMENT PRIMARY KEY
            $table->date('tanggal'); // Kolom tanggal
            $table->time('waktu'); // Kolom waktu
            $table->string('nama_pengajar'); // Kolom nama_pengajar
            $table->string('mapel'); // Kolom mapel
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
        Schema::dropIfExists('suratkeputusan');
    }
}