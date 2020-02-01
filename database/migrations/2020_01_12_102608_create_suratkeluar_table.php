<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratkeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratkeluar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_surat')->unique();
            $table->string('tujuan_surat');
            $table->string('isi');
            $table->string('kode');
            $table->date('tgl_surat');
            $table->date('tgl_catat');
            $table->string('filekeluar');
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
        Schema::dropIfExists('suratkeluar');
    }
}
