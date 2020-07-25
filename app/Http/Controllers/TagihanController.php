<?php

namespace App\Http\Controllers;

use App\Rombel;
use App\Tagihan;
use App\Anggotarombel;
use App\Instansi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

class TagihanController extends Controller
{
    public function index()
    {
        // $data_rombel = \App\Rombel::all();
        $daftar_rombel = \App\Tagihan::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();
        $data_tagihan = \App\Tagihan::orderByRaw('created_at DESC')->get();
        return view('/pembayaran/tagihan/index', compact('daftar_rombel', 'data_tagihan'));
    }

    public function create()
    {
        $tapel_terakhir = \App\Tapel::select('id')->max('id');
        $data_rombel = \App\Rombel::where('tapel_id', $tapel_terakhir)->get();
        $data_tagihan = \App\Tagihan::all();
        return view('/pembayaran/tagihan/create', compact('data_rombel', 'data_tagihan'));
    }

    function tambah(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'rombel_id.*'  => 'required',
                'rincian.*'  => 'required|min:5',
                'jenis_kelamin.*'  => 'required',
                'nominal.*'  => 'required|numeric|min:4',
                'batas_bayar.*'  => 'required'
            );

            $rombel_id = $request->rombel_id;
            $rincian = $request->rincian;
            $jenis_kelamin = $request->jenis_kelamin;
            $nominal = $request->nominal;
            $batas_bayar = $request->batas_bayar;
            for ($count = 0; $count < count($rombel_id); $count++) {
                $data = array(
                    'rombel_id' => $rombel_id[$count],
                    'rincian'  => $rincian[$count],
                    'jenis_kelamin'  => $jenis_kelamin[$count],
                    'nominal'  => $nominal[$count],
                    'batas_bayar'  => $batas_bayar[$count],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now()
                );
                $insert_data[] = $data;
            }

            Tagihan::insert($insert_data);
            return response()->json([
                'success'  => 'Data Rincian Tagihan Berhasil Ditambahkan !!!'
            ]);
        }
    }


    //function untuk masuk ke view edit
    public function edit($id_tagihan)
    {
        $tagihan = \App\Tagihan::find($id_tagihan);
        return view('/pembayaran/tagihan/edit', compact('tagihan'));
    }

    public function update(Request $request, $id_tagihan)
    {
        $request->validate([
            'nominal' => 'numeric',
        ]);
        $tagihan_id = \App\TransaksiPembayaran::find($id_tagihan);
        $tagihan = \App\Tagihan::find($id_tagihan);
        $tagihan->update($request->all());
        $tagihan->save();
        return redirect('/pembayaran/tagihan/index')->with('sukses', 'Data Rincian Tagihan Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        try {
            $tagihan = \App\Tagihan::find($id);
            $tagihan->delete();
            return redirect('/pembayaran/tagihan/index')->with('sukses', 'Data Rincian Tagihan Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }

    //function untuk masuk ke view filter
    public function filter(Request $request)
    {
        $filter = $request->input('rombel_filter');

        $data_tagihan_L = \App\Tagihan::where('rombel_id', $filter)
            ->where(function ($query) {
                $query->where('jenis_kelamin', 'Laki-Laki')
                    ->orWhere('jenis_kelamin', 'Semua');
            })->get();

        $data_tagihan_P = \App\Tagihan::where('rombel_id', $filter)
            ->where(function ($query) {
                $query->where('jenis_kelamin', 'Perempuan')
                    ->orWhere('jenis_kelamin', 'Semua');
            })->get();

        $header = $data_tagihan_L->first();

        return view('/pembayaran/tagihan/filter', compact('data_tagihan_L', 'data_tagihan_P', 'header', 'filter'));
    }

    //function untuk print
    public function print($rombel_id)
    {
        $filter = $rombel_id;

        $data_tagihan_L = \App\Tagihan::where('rombel_id', $filter)
            ->where(function ($query) {
                $query->where('jenis_kelamin', 'Laki-Laki')
                    ->orWhere('jenis_kelamin', 'Semua');
            })->get();

        $data_tagihan_P = \App\Tagihan::where('rombel_id', $filter)
            ->where(function ($query) {
                $query->where('jenis_kelamin', 'Perempuan')
                    ->orWhere('jenis_kelamin', 'Semua');
            })->get();

        $header = $data_tagihan_L->first();
        $data_instansi = \App\Instansi::first();
        return view('/pembayaran/tagihan/print', compact('data_tagihan_L', 'data_tagihan_P', 'header', 'filter', 'data_instansi'));
    }
}
