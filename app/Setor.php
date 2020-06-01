<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setor';
    protected $fillable = ['pesdik_id','tanggal','jumlah','keterangan','users_id'];

    //function relasi ke Pesdik
    public function pesdik()
      {
          return $this->belongsTo('Laravel\Pesdik');
      }

    //function relasi ke User
    public function users()
      {
        return $this->belongsTo('Laravel\User');
      }
}
