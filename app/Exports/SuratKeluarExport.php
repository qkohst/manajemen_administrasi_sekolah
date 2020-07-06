<?php

namespace App\Exports;

use App\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratKeluarExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return SuratKeluar::select('id', 'isi', 'tujuan_surat', 'klasifikasi_id', 'no_surat', 'tgl_surat', 'tgl_catat', 'keterangan')->get();
    }
}
