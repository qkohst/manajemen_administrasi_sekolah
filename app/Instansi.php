<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $fillable = ['nama','alamat','pimpinan','email','file'];
}
