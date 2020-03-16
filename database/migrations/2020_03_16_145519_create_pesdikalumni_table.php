<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesdikalumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesdikalumni', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('nisn');
            $table->string('induk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_pendaftaran');
            $table->date('tanggal_masuk');
            $table->date('tanggal_lulus');
            $table->string('melanjutkan_ke');
            $table->string('keterangan');
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
        Schema::dropIfExists('pesdikalumni');
    }
}
