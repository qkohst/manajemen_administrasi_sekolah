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
            $table->string('no_surat')->unique();
            $table->string('asal_surat');
            $table->text('isi');
            $table->char('kode');
            $table->date('tgl_surat');
            $table->date('tgl_terima');
            $table->string('filemasuk');
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
