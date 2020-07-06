<?php

use Illuminate\Support\Facades\Schema;
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
        //Foreign Key Manajemen Surat
        Schema::table('suratmasuk', function ($table) {
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('suratmasuk', function ($table) {
            $table->foreign('klasifikasi_id')
                ->references('id')->on('klasifikasi')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('suratkeluar', function ($table) {
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('suratkeluar', function ($table) {
            $table->foreign('klasifikasi_id')
                ->references('id')->on('klasifikasi')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('disposisis', function ($table) {
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('disposisis', function ($table) {
            $table->foreign('suratmasuk_id')
                ->references('id')->on('suratmasuk')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        //Foreign Key Data Master
        Schema::table('rombel', function ($table) {
            $table->foreign('tapel_id')
                ->references('id')->on('tapel')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('rombel', function ($table) {
            $table->foreign('guru_id')
                ->references('id')->on('guru')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('anggotarombel', function ($table) {
            $table->foreign('pesdik_id')
                ->references('id')->on('pesdik')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('anggotarombel', function ($table) {
            $table->foreign('rombel_id')
                ->references('id')->on('rombel')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('pesdik', function ($table) {
            $table->foreign('rombel_id')
                ->references('id')->on('rombel')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('pesdikkeluar', function ($table) {
            $table->foreign('pesdik_id')
                ->references('id')->on('pesdik')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('pesdikalumni', function ($table) {
            $table->foreign('pesdik_id')
                ->references('id')->on('pesdik')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('pengumuman', function ($table) {
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('tagihan', function ($table) {
            $table->foreign('rombel_id')
                ->references('id')->on('rombel')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('transaksipembayaran', function ($table) {
            $table->foreign('tagihan_id')
                ->references('id')->on('tagihan')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('transaksipembayaran', function ($table) {
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('transaksipembayaran', function ($table) {
            $table->foreign('pesdik_id')
                ->references('id')->on('pesdik')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('transaksipembayaran', function ($table) {
            $table->foreign('rombel_id')
                ->references('id')->on('rombel')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('tarik', function ($table) {
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('tarik', function ($table) {
            $table->foreign('pesdik_id')
                ->references('id')->on('pesdik')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('tarik', function ($table) {
            $table->foreign('rombel_id')
                ->references('id')->on('rombel')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('setor', function ($table) {
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('setor', function ($table) {
            $table->foreign('pesdik_id')
                ->references('id')->on('pesdik')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('setor', function ($table) {
            $table->foreign('rombel_id')
                ->references('id')->on('rombel')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('pemasukan', function ($table) {
            $table->foreign('kategori_id')
                ->references('id')->on('kategori')
                ->onDelete('restrict')->onUpdate('restrict');
        });

        Schema::table('pengeluaran', function ($table) {
            $table->foreign('kategori_id')
                ->references('id')->on('kategori')
                ->onDelete('restrict')->onUpdate('restrict');
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
