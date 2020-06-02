<?php

namespace App\Http\Controllers;
use App\User;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(User $pengguna)
    {
        $data_pengguna = $pengguna->all();
        $data_pengumuman = \App\Pengumuman::orderByRaw('created_at DESC')->limit(5)->get();
        return view('dashboard', compact('data_pengguna','data_pengumuman'));
    }
}
