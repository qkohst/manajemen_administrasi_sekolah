<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $fillable = ['kategori_id','tanggal','jumlah','keterangan'];

    //function relasi ke tapel
    public function kategori()
      {
          return $this->belongsTo('App\Kategori');
      }
}
