<?php

namespace App\Http\Controllers;

use App\Rombel;
use App\Tagihan;
use App\Anggotarombel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    public function index()
    {
        $data_rombel = \App\Rombel::all();
        $data_tagihan = \App\Tagihan::all();
        $data_anggotarombel = \App\Anggotarombel::all();
        return view('/pembayaran/tagihan/index', compact('data_rombel','data_tagihan','data_anggotarombel'));
    }
}
