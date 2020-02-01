<?php

namespace App\Http\Controllers;
use App\Disposisi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    public function index(Request $request)
    {
        $data_disposisi = \App\Disposisi::all();
        return view('disposisi.index',['data_disposisi'=> $data_disposisi]);
    }
}
