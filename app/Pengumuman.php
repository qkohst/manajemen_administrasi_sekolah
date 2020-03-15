<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = ['judul','isi','users_id'];

     //function relasi ke user
     public function users()
     {
         return $this->belongsTo('App\User');
     }
}
