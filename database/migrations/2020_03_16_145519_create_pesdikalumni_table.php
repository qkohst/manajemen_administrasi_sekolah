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
            $table->integer('pesdik_id')->unsigned();
            $table->date('tanggal_lulus');
            $table->string('melanjutkan_ke', 20);
            $table->string('keterangan', 100);
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
