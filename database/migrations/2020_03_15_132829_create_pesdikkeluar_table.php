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
            $table->integer('pesdik_id')->unsigned();
            $table->string('keluar_karena', 20);
            $table->date('tanggal_keluar');
            $table->string('alasan_keluar', 100);
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
