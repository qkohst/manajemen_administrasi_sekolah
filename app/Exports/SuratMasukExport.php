<?php

namespace App\Exports;

use App\SuratMasuk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class SuratMasukExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view('suratmasuk.downloadexcel', [
            'suratmasuk' => SuratMasuk::all()
        ]);
    }
}
