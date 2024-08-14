<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_sk')->unique();
            $table->date('tanggal_sk');
            $table->year('tahun');
            $table->longText('tentang');            // Menggunakan longText untuk mendukung konten HTML
            $table->longText('menimbang');          // Menggunakan longText untuk mendukung konten HTML
            $table->longText('mengingat');          // Menggunakan longText untuk mendukung konten HTML
            $table->longText('memperhatikan');      // Menggunakan longText untuk mendukung konten HTML
            $table->longText('menetapkan');         // Menggunakan longText untuk mendukung konten HTML
            $table->longText('tembusan');           // Menggunakan longText untuk mendukung konten HTML
            $table->longText('isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk');
    }
}
