<?php

namespace App\Exports;

use App\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratMasukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SuratMasuk::select('id', 'isi', 'asal_surat', 'klasifikasi_id', 'no_surat', 'tgl_surat', 'tgl_terima', 'keterangan')->get();
    }
}
