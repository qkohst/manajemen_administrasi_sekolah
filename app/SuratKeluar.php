<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suratkeluar extends Model
{
    protected $table = 'suratkeluar';
    protected $fillable = ['no_surat','tujuan_surat','isi','kode','tgl_surat','tgl_catat','filekeluar','keterangan','users_id'];

    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
