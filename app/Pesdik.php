<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Pesdik extends Model
{
    protected $table = 'pesdik';
    protected $fillable = ['status','nama','jenis_kelamin','nisn','induk','rombel_id','tempat_lahir','tanggal_lahir','jenis_pendaftaran','tanggal_masuk'];

    //function relasi ke rombel
    public function rombel()
     {
         return $this->belongsTo('Laravel\Rombel');
     }
}
