<?php

namespace App\Exports;

use App\TransaksiPembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiPembayaranExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransaksiPembayaran::all();
    }
}
