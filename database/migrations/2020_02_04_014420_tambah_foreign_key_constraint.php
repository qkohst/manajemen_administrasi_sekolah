<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahForeignKeyConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suratmasuk', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('suratkeluar', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('disposisis', function($table) {
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('disposisis', function($table) {
            $table->foreign('suratmasuk_id')
                  ->references('id')->on('suratmasuk')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
