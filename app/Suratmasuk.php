<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suratmasuk extends Model
{
    protected $table = 'suratmasuk';
    protected $fillable = ['no_surat','asal_surat','isi','kode','tgl_surat','tgl_terima','filemasuk','keterangan','users_id'];

    //function relasi ke disposisi
    public function disposisi()
    {
        return $this->hasMany('App\Disposisi');
    }

    //function relasi ke user
    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
