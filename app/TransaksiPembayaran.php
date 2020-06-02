<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    protected $table = 'transaksipembayaran';
    protected $fillable = ['tagihan_id','users_id','pesdik_id','id_rombel','jumlah_bayar'];

    public function tagihan()
      {
          return $this->belongsTo('App\Tagihan');
      }

    public function pesdik()
      {
          return $this->belongsTo('App\Pesdik');
      }

    public function users()
      {
        return $this->belongsTo('App\User');
      }

    public function rombel()
      {
        return $this->belongsTo('App\Rombel');
      }
}
