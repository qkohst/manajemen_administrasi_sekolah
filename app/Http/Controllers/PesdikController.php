<?php

namespace App\Http\Controllers;

use App\Pesdik;
use App\Pesdikkeluar;
use App\Pesdikalumni;
use App\Anggotarombel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PesdikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pesdik = \App\Pesdik::where('status', 'Aktif')->orderByRaw('nama ASC')->get();
        return view('pesdik.index', ['data_pesdik' => $data_pesdik]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $tapel_terakhir = \App\Rombel::max('tapel_id');
        $data_rombel = \App\Rombel::where('tapel_id', $tapel_terakhir)->orderByRaw('kelas ASC')->get();
        return view('pesdik.create', ['data_rombel' => $data_rombel]);
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'min:5',
            'nisn' => 'unique:pesdik|size:10',
            'induk' => 'unique:pesdik|min:2|max:6',
        ]);
        //Menambah data ke tabel pesdik
        $pesdik = new Pesdik();
        $pesdik->status  = 'Aktif';
        $pesdik->nama     = $request->input('nama');
        $pesdik->jenis_kelamin = $request->input('jenis_kelamin');
        $pesdik->nisn          = $request->input('nisn');
        $pesdik->induk         = $request->input('induk');
        $pesdik->rombel_id     = $request->input('rombel');
        $pesdik->tempat_lahir    = $request->input('tempat_lahir');
        $pesdik->tanggal_lahir   = $request->input('tanggal_lahir');
        $pesdik->jenis_pendaftaran   = $request->input('jenis_pendaftaran');
        $pesdik->tanggal_masuk   = $request->input('tanggal_masuk');
        $pesdik->save();

        // Menambah data ke anggota rombel 
        $anggotarombel = new Anggotarombel();
        $anggotarombel->pesdik_id       = $pesdik->id;
        $anggotarombel->rombel_id       = $request->input('rombel');
        $anggotarombel->save();

        // Menambah acount user dengan role Siswa
        $nisn = $request->input('nisn');
        $extensi = "@siswa.com";
        $buatUsername = $nisn . $extensi;
        $role = "Siswa";
        $pengguna = User::create([
            'name' => $request->input('nama'),
            'email' => $buatUsername,
            'password' => Hash::make($request->input('nisn')),
            'role' => $role,
        ]);
        return redirect('/pesdik/index')->with("sukses", "Data Peserta Didik Berhasil Ditambahkan");
    }

    //function untuk masuk ke modal
    public function registrasi($id_pesdik)
    {
        $pesdik = \App\Pesdik::find($id_pesdik);
        $data_rombel = \App\Rombel::all();
        return view('pesdik/registrasi', ['pesdik' => $pesdik], ['data_rombel' => $data_rombel]);
    }

    //function untuk registrasi keluar
    public function keluar(Request $request, $id_pesdik)
    {
        $request->validate([
            'alasan_keluar' => 'min:10',
        ]);
        $pesdik = \App\Pesdik::find($id_pesdik);
        $reg      = 'Keluar';

        $pesdikkeluar = new Pesdikkeluar();
        $pesdikkeluar->pesdik_id = $id_pesdik;
        $pesdikkeluar->keluar_karena   = $request->input('keluar_karena');
        $pesdikkeluar->tanggal_keluar   = $request->input('tanggal_keluar');
        $pesdikkeluar->alasan_keluar   = $request->input('alasan_keluar');
        $pesdikkeluar->save();

        $pesdik->status = $reg;
        $pesdik->update();
        return redirect('pesdik/index')->with('sukses', 'Registrasi Peserta Didik Keluar, Berhasil !');
    }

    //function untuk masuk ke view pesdik keluar
    public function keluarindex()
    {
        $data_pesdikkeluar = \App\Pesdikkeluar::orderByRaw('pesdik_id ASC')->get();
        return view('pesdik.keluarindex', compact('data_pesdikkeluar'));
    }

    //function untuk registrasi alumni
    public function alumni(Request $request, $id_pesdik)
    {
        $request->validate([
            'keterangan' => 'min:10',
        ]);
        $pesdik = \App\Pesdik::find($id_pesdik);
        $reg      = 'Lulus';

        $pesdikalumni = new Pesdikalumni();

        $pesdikalumni->pesdik_id    = $id_pesdik;
        $pesdikalumni->tanggal_lulus   = $request->input('tanggal_lulus');
        $pesdikalumni->melanjutkan_ke   = $request->input('melanjutkan_ke');
        $pesdikalumni->keterangan   = $request->input('keterangan');
        $pesdikalumni->save();
        $pesdik->status = $reg;
        $pesdik->update();
        return redirect('pesdik/index')->with('sukses', 'Registrasi Peserta Didik Lulus, Berhasil !');
    }

    //function untuk masuk ke view pesdik alumni
    public function alumniindex()
    {
        $data_pesdikalumni = \App\Pesdikalumni::orderByRaw('pesdik_id ASC')->get();
        return view('pesdik.alumniindex', ['data_pesdikalumni' => $data_pesdikalumni]);
    }

    //function untuk masuk ke view edit
    public function edit($id_pesdik)
    {
        $pesdik = \App\Pesdik::find($id_pesdik);
        return view('pesdik/edit', ['pesdik' => $pesdik]);
    }
    public function update(Request $request, $id_pesdik)
    {
        $request->validate([
            'nama' => 'min:5',
            'nisn' => 'size:10',
            'induk' => 'min:2|max:6',
        ]);
        $pesdik = \App\Pesdik::find($id_pesdik);
        $pesdik->update($request->all());
        $pesdik->save();
        return redirect('pesdik/index')->with('sukses', 'Data Peserta Didik Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_pesdik)
    {
        try {
            $pesdik = \App\Pesdik::find($id_pesdik);
            $pesdik->delete();
            return redirect('pesdik/index')->with('sukses', 'Data Peserta Didik Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }
}
