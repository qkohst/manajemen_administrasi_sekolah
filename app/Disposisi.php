<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $fillable = ['tujuan', 'isi', 'sifat', 'batas_waktu', 'catatan', 'users_id', 'suratmasuk_id'];

    public function suratmasuk()
    {
        return $this->belongsTo('App\SuratMasuk');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
