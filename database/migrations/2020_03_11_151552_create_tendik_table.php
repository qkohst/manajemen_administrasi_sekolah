<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTendikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tendik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 30);
            $table->string('jenis_kelamin', 9);
            $table->string('tempat_lahir', 25);
            $table->date('tanggal_lahir');
            $table->string('alamat', 100);
            $table->string('no_hp', 13);
            $table->string('email', 35);
            $table->string('tugas', 35);
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
        Schema::dropIfExists('tendik');
    }
}
