<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesdikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesdik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 7);
            $table->string('nama', 30);
            $table->string('jenis_kelamin', 9);
            $table->string('nisn', 10);
            $table->string('induk', 6);
            $table->integer('rombel_id')->unsigned();
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->string('jenis_pendaftaran', 10);
            $table->date('tanggal_masuk');
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
        Schema::dropIfExists('pesdik');
    }
}
