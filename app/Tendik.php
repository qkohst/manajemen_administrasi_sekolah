<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    protected $table = 'tendik';
    protected $fillable = ['nama','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat','no_hp','email','tugas'];
}
