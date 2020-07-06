<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suratmasuk extends Model
{
    protected $table = 'suratmasuk';
    protected $fillable = ['klasifikasi_id', 'users_id', 'no_surat', 'asal_surat', 'isi', 'tgl_surat', 'tgl_terima', 'filemasuk', 'keterangan'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function klasifikasi()
    {
        return $this->belongsTo('App\Klasifikasi');
    }

    public function disposisis()
    {
        return $this->hasMany('App\Disposisi');
    }
}
