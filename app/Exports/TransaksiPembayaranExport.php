<?php

namespace App\Exports;

use App\TransaksiPembayaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransaksiPembayaranExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('laporankeuangan.transaksipembayaran.DownloadExcel', [
            'data_transaksi' => TransaksiPembayaran::all(),
            'total_transaksi' => TransaksiPembayaran::all()->sum('jumlah_bayar'),
        ]);
    }
}
