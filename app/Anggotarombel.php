<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Anggotarombel extends Model
{
    protected $table = 'anggotarombel';
    protected $fillable = ['pesdik_id','rombel_id'];

    public function pesdik()
    {
        return $this->belongsTo('Laravel\Pesdik');
    }

    public function rombel()
    {
        return $this->belongsTo('Laravel\Rombel');
    }
}
