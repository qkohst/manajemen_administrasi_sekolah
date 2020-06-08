<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        $cre = $request->only('email','password');
        if (Auth::attempt($cre)) {
            return redirect('/dashboard');
        }
        return redirect()->back()->with('error','Email atau Password Salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function gantipassword($id)
    {
        $data_pengguna= User::findorfail($id);
        return view('auths.gantipassword', compact('data_pengguna'));
    }

    public function simpanpassword(Request $request, $id)
    {
        $pengguna= User::findorfail($id);
        $password_baru=$request->input('password_baru');
        $konfirmasi_password_baru=$request->input('konfirmasi_password_baru');
        // dd($konfirmasi_password_baru);
        if ($password_baru==$konfirmasi_password_baru) {
            $data_pengguna = [
                'name' => $pengguna->name,
                'email' => $pengguna->email,
                'password' => Hash::make($request->input('password_baru')),
                'role' => $pengguna->role,
            ];
            $pengguna->update($data_pengguna);

            return redirect('/login')->with('sukses','Password anda telah diperbarui, silahkan login dengan menggunakan  Password baru Anda');
        }
        return redirect()->back()->with('error','Harap Masukkan Konfirmasi Password Dengan Benar !!');
    }
}
