<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['jenis_kategori', 'nama_kategori'];

    public function pemasukan()
    {
        return $this->hasMany('App\Pemasukan');
    }

    public function pengeluaran()
    {
        return $this->hasMany('App\Pengeluaran');
    }
}
