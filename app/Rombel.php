<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table = 'rombel';
    protected $fillable = ['tapel_id','kelas','nama_rombel','wali_kelas'];

    //function relasi ke tapel
    public function tapel()
    {
        return $this->belongsTo('App\Tapel');
    }
}
