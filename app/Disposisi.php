<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $fillable = ['tujuan','isi','sifat','batas_waktu','catatan','users_id'];


}
