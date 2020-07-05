<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesdikkeluar extends Model
{
    protected $table = 'pesdikkeluar';
    protected $fillable = ['pesdik_id', 'keluar_karena', 'tanggal_keluar', 'alasan_keluar'];

    public function pesdik()
    {
        return $this->belongsTo('App\Pesdik');
    }
}
