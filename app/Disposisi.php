<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $fillable = ['tujuan','isi','sifat','batas_waktu','catatan','users_id','suratmasuk_id'];

    public function smasuk()
    {
        return $this->belongsTo('Laravel\SuratMasuk');
    }
}
