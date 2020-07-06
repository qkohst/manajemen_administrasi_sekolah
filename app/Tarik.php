<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarik extends Model
{
  protected $table = 'tarik';
  protected $fillable = ['pesdik_id', 'rombel_id', 'tanggal', 'jumlah', 'keterangan', 'users_id'];

  public function users()
  {
    return $this->belongsTo('App\User');
  }

  public function pesdik()
  {
    return $this->belongsTo('App\Pesdik');
  }

  public function rombel()
  {
    return $this->belongsTo('App\Rombel');
  }
}
