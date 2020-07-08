<?php

namespace App\Exports;

use App\SuratKeluar;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SuratKeluarExport implements FromView,ShouldAutoSize
{
    public function view(): View
    {
        return view('suratkeluar.downloadexcel', [
            'suratkeluar' => SuratKeluar::all()
        ]);
    }
}
