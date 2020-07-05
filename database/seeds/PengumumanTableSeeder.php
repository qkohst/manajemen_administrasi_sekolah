<?php

use Illuminate\Database\Seeder;

class PengumumanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Pengumuman::create([
            'judul'  => 'Setting Data Master',
            'isi' => 'Pastikan administrator sudah melakukan setting data master pada menu KELOLA DATA, mulai dari data Sekolah, GTK, Tahun Pelajaran, Rombongan Belajar dan Peserta Didik.',
            'users_id' => '1'
        ]);
    }
}
