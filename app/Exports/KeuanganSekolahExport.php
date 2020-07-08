<?php

namespace App\Exports;

use App\Pemasukan;
use App\Pengeluaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KeuanganSekolahExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('laporankeuangan.keuangansekolah.DownloadExcel', [
            'data_pemasukan' => Pemasukan::all(),
            'total_pemasukan' => Pemasukan::all()->sum('jumlah'),
            'data_pengeluaran' => Pengeluaran::all(),
            'total_pengeluaran' => Pengeluaran::all()->sum('jumlah'),
        ]);
    }
}
