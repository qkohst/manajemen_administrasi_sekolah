<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesdikalumni extends Model
{
    protected $table = 'pesdikalumni';
    protected $fillable = ['nama','jenis_kelamin','nisn','induk','tempat_lahir','tanggal_lahir','jenis_pendaftaran','tanggal_masuk','tanggal_lulus','melanjutkan_ke','keterangan'];
}
