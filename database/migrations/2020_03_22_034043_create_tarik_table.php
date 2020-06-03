<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarik', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pesdik_id');
            $table->integer('id_rombel');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->string('keterangan');
            $table->integer('users_id');
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
        Schema::dropIfExists('tarik');
    }
}
