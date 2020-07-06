<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    protected $table = 'klasifikasi';
    protected $fillable = ['nama', 'kode', 'uraian'];

    public function suratmasuk()
    {
        return $this->hasMany('App\Suratmasuk');
    }

    public function suratkeluar()
    {
        return $this->hasMany('App\Suratkeluar');
    }
}
