<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table = 'rombel';
    protected $fillable = ['kelas','nama_rombel','wali_kelas'];
}
