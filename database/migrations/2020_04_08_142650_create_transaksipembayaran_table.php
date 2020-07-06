<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksipembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksipembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tagihan_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->integer('pesdik_id')->unsigned();
            $table->integer('rombel_id')->unsigned();
            $table->integer('jumlah_bayar');
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
        Schema::dropIfExists('transaksipembayaran');
    }
}
