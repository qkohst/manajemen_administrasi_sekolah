<?php

namespace App\Http\Controllers;

use App\User;
use App\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // return view('auths.login');
        if (auth()->user()) {
            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard')->with('warning', 'Maaf tindakan anda tidak dibenarkan, tidak usah macem-macem lah !');
            } else if (auth()->user()->role == 'Siswa') {
                return redirect()->back()->with('warning', 'Maaf tindakan anda tidak dibenarkan, tidak usah macem-macem lah !');
            } else if (auth()->user()->role == 'PetugasAdministrasiKeuangan') {
                return redirect('/dashboard')->with('warning', 'Maaf tindakan anda tidak dibenarkan, tidak usah macem-macem lah !');
            } else if (auth()->user()->role == 'PetugasAdministrasiSurat') {
                return redirect('/dashboard')->with('warning', 'Maaf tindakan anda tidak dibenarkan, tidak usah macem-macem lah !');
            }
        }
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        $cre = $request->only('email', 'password');
        if (Auth::attempt($cre)) {
            //mengambil data siswa login
            $siswalogin = $request->input('email');
            $pisah_email = explode("@", $siswalogin);
            $nisn = $pisah_email[0];
            $id_pesdik = \App\Pesdik::where('nisn', $nisn)->get();
            $id_pesdik_login = $id_pesdik->first();

            //data untuk ditampilkan ke dashboard
            $data_login = \App\Login::orderByRaw('created_at DESC')->limit(25)->get();
            $data_admin = \App\User::where('role', "admin")->get();
            $data_petugas = \App\Tendik::all();
            $data_pengumuman = \App\Pengumuman::orderByRaw('created_at DESC')->limit(5)->get();

            //Riwayat Login
            $email = $request->input('email');
            $id_pengguna = \App\User::select('name')->where('email', $email)->get();
            $pengguna_login = $id_pengguna->first();

            $login = new Login();
            $login->name   = $pengguna_login->name;
            $login->email   = $email;
            $login->save();
            //EndRiwayat Login

            return view('/dashboard', compact('data_admin', 'data_login', 'data_pengumuman', 'data_petugas', 'id_pesdik_login'));
        }
        return redirect()->back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function gantipassword($id)
    {
        $data_pengguna = User::findorfail($id);
        return view('auths.gantipassword', compact('data_pengguna'));
    }

    public function simpanpassword(Request $request, $id)
    {
        $pengguna = User::findorfail($id);
        $password_baru = $request->input('password_baru');
        $konfirmasi_password_baru = $request->input('konfirmasi_password_baru');
        if ($password_baru == $konfirmasi_password_baru) {
            $data_pengguna = [
                'name' => $pengguna->name,
                'email' => $pengguna->email,
                'password' => Hash::make($request->input('password_baru')),
                'role' => $pengguna->role,
            ];
            $pengguna->update($data_pengguna);

            return redirect('/login')->with('sukses', 'Password anda telah diperbarui.');
        }
        return redirect()->back()->with('error', 'Harap Masukkan Konfirmasi Password Dengan Benar !!');
    }
}
