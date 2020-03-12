<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesdik extends Model
{
    protected $table = 'pesdik';
    protected $fillable = ['nama','jenis_kelamin','nisn','induk','rombel','tempat_lahir','tanggal_lahir','jenis_pendaftaran','tanggal_masuk'];
}
