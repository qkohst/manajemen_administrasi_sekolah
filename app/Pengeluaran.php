<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $fillable = ['kategori_id', 'jumlah', 'keterangan'];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
