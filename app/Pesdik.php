<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesdik extends Model
{
    protected $table = 'pesdik';
    protected $fillable = ['status', 'nama', 'jenis_kelamin', 'nisn', 'induk', 'rombel_id', 'tempat_lahir', 'tanggal_lahir', 'jenis_pendaftaran', 'tanggal_masuk'];

    //function relasi ke rombel
    public function anggotarombel()
    {
        return $this->hasMany('App\Anggotarombel');
    }

    public function rombel()
    {
        return $this->belongsTo('App\Rombel');
    }

    public function pesdikkeluar()
    {
        return $this->hasOne('App\Pesdikkeluar');
    }

    public function pesdikalumni()
    {
        return $this->hasOne('App\Pesdikalumni');
    }

    public function transaksipembayaran()
    {
        return $this->hasMany('App\TransaksiPembayaran');
    }

    public function tarik()
    {
        return $this->hasMany('App\Tarik');
    }

    public function setor()
    {
        return $this->hasMany('App\Setor');
    }
}
