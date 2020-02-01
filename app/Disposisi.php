<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = 'disposisi';
    protected $fillable = ['tujuan','isi','sifat','batas_waktu','catatan'];

    //function relasi ke suratmasuk
    public function suratmasuk()
    {
        return $this->belongsTo(Suratmasuk::class);
    }
}
