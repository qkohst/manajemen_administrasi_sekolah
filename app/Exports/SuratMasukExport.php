<?php

namespace Laravel\Exports;

use Laravel\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratMasukExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SuratMasuk::select('id', 'isi', 'asal_surat', 'kode', 'no_surat', 'tgl_surat', 'tgl_terima', 'keterangan')->get();
    }
}
