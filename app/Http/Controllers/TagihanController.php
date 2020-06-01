<?php

namespace Laravel\Http\Controllers;

use Laravel\Rombel;
use Laravel\Tagihan;
use Laravel\Anggotarombel;
use Laravel\Instansi;
use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

class TagihanController extends Controller
{
    public function index()
    {
        $data_rombel = \Laravel\Rombel::all();
        $data_tagihan = \Laravel\Tagihan::all();
        $data_anggotarombel = \Laravel\Anggotarombel::all();
        return view('/pembayaran/tagihan/index', compact('data_rombel', 'data_tagihan', 'data_anggotarombel'));
    }

    public function create()
    {
        $data_rombel = \Laravel\Rombel::all();
        $data_tagihan = \Laravel\Tagihan::all();
        $data_anggotarombel = \Laravel\Anggotarombel::all();
        return view('/pembayaran/tagihan/create', compact('data_rombel', 'data_tagihan', 'data_anggotarombel'));
    }

    function tambah(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'rombel_id.*'  => 'required',
                'rincian.*'  => 'required',
                'jenis_kelamin.*'  => 'required',
                'nominal.*'  => 'required|numeric',
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
        $tagihan = \Laravel\Tagihan::find($id_tagihan);
        return view('/pembayaran/tagihan/edit', compact('tagihan'));
    }

    public function update(Request $request, $id_tagihan)
    {
        $request->validate([
            'nominal' => 'numeric',
        ]);
        $tagihan = \Laravel\Tagihan::find($id_tagihan);
        $tagihan->update($request->all());
        $tagihan->save();
        return redirect('/pembayaran/tagihan/index')->with('sukses', 'Data Rincian Tagihan Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $tagihan = \Laravel\Tagihan::find($id);
        $tagihan->delete();
        return redirect('/pembayaran/tagihan/index')->with('sukses', 'Data Rincian Tagihan Berhasil Dihapus');
    }

    //function untuk masuk ke view filter
    public function filter(Request $request)
    {
        $filter = $request->input('rombel_filter');

        $data_tagihan_L = \Laravel\Tagihan::where('rombel_id', $filter)
            ->where(function ($query) {
                $query->where('jenis_kelamin', 'Laki-Laki')
                    ->orWhere('jenis_kelamin', 'Semua');
            })->get();

        $data_tagihan_P = \Laravel\Tagihan::where('rombel_id', $filter)
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

        $data_tagihan_L = \Laravel\Tagihan::where('rombel_id', $filter)
            ->where(function ($query) {
                $query->where('jenis_kelamin', 'Laki-Laki')
                    ->orWhere('jenis_kelamin', 'Semua');
            })->get();

        $data_tagihan_P = \Laravel\Tagihan::where('rombel_id', $filter)
            ->where(function ($query) {
                $query->where('jenis_kelamin', 'Perempuan')
                    ->orWhere('jenis_kelamin', 'Semua');
            })->get();

        $header = $data_tagihan_L->first();
        $data_instansi = \Laravel\Instansi::first();
        return view('/pembayaran/tagihan/print', compact('data_tagihan_L', 'data_tagihan_P', 'header', 'filter', 'data_instansi'));
    }
}
