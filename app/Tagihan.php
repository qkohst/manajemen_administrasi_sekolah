<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';
    protected $fillable = ['rombel_id','rincian','jenis_kelamin','nominal','batas_bayar'];

     //function relasi ke rombel
     public function rombel()
     {
         return $this->belongsTo('App\Rombel');
     }

     public function transaksipembayaran()
     {
         return $this->hasMany('App\TransaksiPembayaran');
     }
}
