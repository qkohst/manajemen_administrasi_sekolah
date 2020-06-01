<?php

namespace Laravel\Exports;

use Laravel\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratKeluarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SuratKeluar::select('id', 'isi', 'tujuan_surat', 'kode', 'no_surat', 'tgl_surat', 'tgl_catat', 'keterangan')->get();
    }
}
