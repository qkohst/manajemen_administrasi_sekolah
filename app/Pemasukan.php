<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $fillable = ['kategori_id', 'jumlah', 'keterangan'];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
