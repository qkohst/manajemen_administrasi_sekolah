<?php

namespace App\Exports;

use App\Setor;
use App\Tarik;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SetorTarikExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('laporankeuangan.setortariktunai.DownloadExcel', [
            'data_setor' => Setor::all(),
            'total_setor' => Setor::all()->sum('jumlah'),
            'data_tarik' => Tarik::all(),
            'total_tarik' => Tarik::all()->sum('jumlah'),
        ]);
    }
}
