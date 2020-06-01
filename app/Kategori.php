<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['jenis_kategori','nama_kategori'];

    
}
