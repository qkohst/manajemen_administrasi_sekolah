<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarik extends Model
{
    protected $table = 'tarik';
    protected $fillable = ['pesdik_id','id_rombel','tanggal','jumlah','keterangan','users_id'];

    public function pesdik()
      {
          return $this->belongsTo('App\Pesdik');
      }

    public function users()
      {
        return $this->belongsTo('App\User');
      }

    public function Rombel()
      {
        return $this->belongsTo('App\Rombel');
      }
}
