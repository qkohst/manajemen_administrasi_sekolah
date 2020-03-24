<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggotarombel extends Model
{
    protected $table = 'anggotarombel';
    protected $fillable = ['pesdik_id','rombel_id'];

    public function pesdik()
    {
        return $this->belongsTo('App\Pesdik');
    }

    public function rombel()
    {
        return $this->belongsTo('App\Rombel');
    }
}
