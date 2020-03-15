<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(User $pengguna)
    {
        $data_pengguna = $pengguna->all();
        return view('dashboard', compact('data_pengguna'));
    }
}
