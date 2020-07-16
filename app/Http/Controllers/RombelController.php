<?php

namespace App\Http\Controllers;

use App\Rombel;
use App\Pesdik;
use App\Tapel;
use App\Anggotarombel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_guru = \App\Guru::orderByRaw('nama ASC')->get();
        $tapel_terakhir = \App\Tapel::max('id');
        $data_tapel = \App\Tapel::where('id', $tapel_terakhir)->get();
        $data_rombel = \App\Rombel::where('tapel_id', $tapel_terakhir)->orderByRaw('kelas ASC')->get();
        return view('rombel.index', compact('data_rombel', 'data_guru', 'data_tapel'));
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'nama_rombel' => 'min:3|max:15',
        ]);
        $rombel = new Rombel();
        $rombel->tapel_id   = $request->input('tapel_id');
        $rombel->kelas   = $request->input('kelas');
        $rombel->nama_rombel   = $request->input('nama_rombel');
        $rombel->guru_id   = $request->input('guru_id');
        $rombel->save();
        return redirect('/rombel/index')->with("sukses", "Data Rombongan Belajar Berhasil Ditambahkan");
    }

    //function untuk anggota Rombel
    public function anggota($id_rombel)
    {
        $data_anggota = \App\Pesdik::where('rombel_id', $id_rombel)->orderByRaw('nama ASC')->get();
        $jumlah_anggota_L = \App\Pesdik::where('rombel_id', $id_rombel)->where('jenis_kelamin', "Laki-Laki")->count();
        $jumlah_anggota_P = \App\Pesdik::where('rombel_id', $id_rombel)->where('jenis_kelamin', "Perempuan")->count();
        $rombel = $id_rombel;
        return view('rombel.anggota', compact('data_anggota', 'rombel', 'jumlah_anggota_L', 'jumlah_anggota_P'));
    }

    public function tambahAnggota($rombel)
    {
        $id_rombel = $rombel;
        $tapel_terakhir = \App\Tapel::max('id');
        $rombel_tapel_sebelumnya = \App\Rombel::select('id')->where('tapel_id', $tapel_terakhir - 1)->get();
        $data_pesdik_tapel_sebelumnya = \App\Pesdik::whereIn('rombel_id', $rombel_tapel_sebelumnya)->where('status', "Aktif")->orderByRaw('nama ASC')->get();
        return view('rombel.tambahAnggota', compact('id_rombel', 'data_pesdik_tapel_sebelumnya'));
    }

    public function simpanAnggota(Request $request, $id_rombel)
    {
        $rombel = $id_rombel;
        $pesdik_id = $request->input('pilih');

        if ($pesdik_id > 0) {
            //Untuk Menmbahkan data pada tabel anggota rombel
            for ($count = 0; $count < count($pesdik_id); $count++) {
                $data = array(
                    'pesdik_id' => $pesdik_id[$count],
                    'rombel_id'  => $rombel,
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now()

                );
                $insert_data[] = $data;
            }
            Anggotarombel::insert($insert_data);

            //Untuk Update Data Pada Table Pesdik
            $pesdik_dipilih = \App\Pesdik::whereIn('id', $pesdik_id)->update(['rombel_id' => $rombel]);
            return redirect('rombel/index')->with('sukses', 'Data Anggota Rombel Berhasil Ditambahkan');
        }else{
            return redirect('/rombel/index')->with('warning', 'Maaf belum ada data anggota rombel yang dipilih, mohon ulangi proses dan centang pada checkbox disamping kanan tabel anggota rombongan belajar !');       
        }
    }

    //function untuk masuk ke view edit
    public function edit($id_rombel)
    {
        $rombel = \App\Rombel::find($id_rombel);
        $data_guru = \App\Guru::all();
        return view('rombel/edit', compact('rombel', 'data_guru'));
    }
    public function update(Request $request, $id_rombel)
    {
        $request->validate([
            'nama_rombel' => 'min:3|max:15',
        ]);
        $rombel = \App\Rombel::find($id_rombel);
        $rombel->update($request->all());
        $rombel->save();
        return redirect('rombel/index')->with('sukses', 'Data Rombongan Belajar Berhasil Diedit');
    }
    //function untuk hapus
    public function delete($id)
    {
        try {
            $rombel = \App\Rombel::find($id);
            $rombel->delete();
            return redirect('rombel/index')->with('sukses', 'Data Rombongan Belajar Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }
}
