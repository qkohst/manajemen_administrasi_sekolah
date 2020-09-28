<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratmasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratmasuk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('klasifikasi_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->string('no_surat', 30)->unique();
            $table->string('asal_surat', 50);
            $table->text('isi');
            $table->date('tgl_surat');
            $table->date('tgl_terima');
            $table->string('filemasuk', 100);
            $table->text('keterangan');
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
        Schema::dropIfExists('suratmasuk');
    }
}
