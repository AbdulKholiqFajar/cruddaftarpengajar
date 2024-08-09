<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApproveToSuratkeputusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratkeputusan', function (Blueprint $table) {
            $table->boolean('approve')->default(false)->after('jumlah_bruto'); // Menambahkan kolom approve setelah kolom jumlah_bruto
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suratkeputusan', function (Blueprint $table) {
            $table->id();
            $table->integer('approve')->nullable(); // Atau tipe data sesuai dengan yang digunakan
            // Kolom lain
            $table->timestamps();
        });
    }
}