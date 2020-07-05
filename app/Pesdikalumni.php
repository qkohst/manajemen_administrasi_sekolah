<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesdikalumni extends Model
{
    protected $table = 'pesdikalumni';
    protected $fillable = ['pesdik_id', 'tanggal_lulus', 'melanjutkan_ke', 'keterangan'];

    public function pesdik()
    {
        return $this->belongsTo('App\Pesdik');
    }
}
