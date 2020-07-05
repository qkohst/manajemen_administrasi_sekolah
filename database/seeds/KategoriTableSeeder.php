<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Kategori::create([
            'jenis_kategori'  => '1',
            'nama_kategori' => 'Pembayaran Siswa'
        ]);
    }
}
