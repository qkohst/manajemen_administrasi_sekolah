<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarik extends Model
{
    protected $table = 'tarik';
    protected $fillable = ['pesdik_id','tanggal','jumlah','keterangan','users_id'];

    //function relasi ke Pesdik
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
