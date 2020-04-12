<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    protected $table = 'transaksipembayaran';
    protected $fillable = ['tagihan_id','users_id','pesdik_id','jumlah_bayar'];

    //function relasi ke Pesdik
    public function tagihan()
      {
          return $this->belongsTo('App\Tagihan');
      }

    public function pesdik()
      {
          return $this->belongsTo('App\Pesdik');
      }

    //function relasi ke Pesdik
    public function users()
      {
        return $this->belongsTo('App\User');
      }
}
