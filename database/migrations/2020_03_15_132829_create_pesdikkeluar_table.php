<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesdikkeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesdikkeluar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('nisn');
            $table->string('induk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_pendaftaran');
            $table->date('tanggal_masuk');
            $table->string('rombel_sebelumnya');
            $table->string('keluar_karena');
            $table->date('tanggal_keluar');
            $table->string('alasan_keluar');
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
        Schema::dropIfExists('pesdikkeluar');
    }
}
