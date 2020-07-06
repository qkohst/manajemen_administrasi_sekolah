<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table = 'rombel';
    protected $fillable = ['tapel_id', 'kelas', 'nama_rombel', 'guru_id'];


    public function tapel()
    {
        return $this->belongsTo('App\Tapel');
    }

    public function guru()
    {
        return $this->belongsTo('App\Guru');
    }

    public function anggotarombel()
    {
        return $this->hasMany('App\Anggotarombel');
    }

    public function pesdik()
    {
        return $this->hasOne('App\Pesdik');
    }

    public function tagihan()
    {
        return $this->hasMany('App\Tagihan');
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
