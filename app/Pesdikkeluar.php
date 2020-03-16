<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesdikkeluar extends Model
{
    protected $table = 'pesdikkeluar';
    protected $fillable = ['nama','jenis_kelamin','nisn','induk','tempat_lahir','tanggal_lahir','jenis_pendaftaran','tanggal_masuk','rombel_sebelumnya','keluar_karena','tanggal_keluar','alasan_keluar'];
}
