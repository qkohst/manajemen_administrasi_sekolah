<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table = 'rombel';
    protected $fillable = ['tapel_id','kelas','nama_rombel','guru_id'];

    //function relasi ke tapel
    public function tapel()
    {
        return $this->belongsTo('App\Tapel');
    }
    public function guru()
    {
        return $this->belongsTo('App\Guru');
    }
}
