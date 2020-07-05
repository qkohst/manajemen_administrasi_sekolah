<?php

use Illuminate\Database\Seeder;

class InstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Instansi::create([
            'nama'  => 'Nama Sekolah',
            'alamat' => 'Alamat Sekolah',
            'pimpinan' => 'Nama Kepala Sekolah',
            'email' => 'emailsekolah@gmail.com',
            'file'  => 'File Logo'
        ]);
    }
}
