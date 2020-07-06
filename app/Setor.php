<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
  protected $table = 'setor';
  protected $fillable = ['pesdik_id', 'rombel_id', 'tanggal', 'jumlah', 'keterangan', 'users_id'];

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
