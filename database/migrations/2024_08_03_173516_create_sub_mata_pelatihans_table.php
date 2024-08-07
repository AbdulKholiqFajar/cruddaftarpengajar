<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMataPelatihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_mata_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('code_sub_mata_pelatihan');
            $table->foreignId('mata_pelatihan_id')->constrained('mata_pelatihans')->onDelete('cascade');
            $table->string('sub_mata_pelatihan');
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
        Schema::dropIfExists('sub_mata_pelatihans');
    }
}
