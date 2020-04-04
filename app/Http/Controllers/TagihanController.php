<?php

namespace App\Http\Controllers;

use App\Rombel;
use App\Tagihan;
use App\Anggotarombel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class TagihanController extends Controller
{
    public function index()
    {
        $data_rombel = \App\Rombel::all();
        $data_tagihan = \App\Tagihan::all();
        $data_anggotarombel = \App\Anggotarombel::all();
        return view('/pembayaran/tagihan/index', compact('data_rombel','data_tagihan','data_anggotarombel'));
    }

    public function create()
    {
        $data_rombel = \App\Rombel::all();
        $data_tagihan = \App\Tagihan::all();
        $data_anggotarombel = \App\Anggotarombel::all();
        return view('/pembayaran/tagihan/create', compact('data_rombel','data_tagihan','data_anggotarombel'));
    }

    function tambah(Request $request)
    {
     if($request->ajax())
     {
      $rules = array(
       'rombel_id.*'  => 'required',
       'rincian.*'  => 'required',
       'jenis_kelamin.*'  => 'required',
       'nominal.*'  => 'required|numeric',
       'batas_bayar.*'  => 'required'
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

      $rombel_id = $request->rombel_id;
      $rincian = $request->rincian;
      $jenis_kelamin = $request->jenis_kelamin;
      $nominal = $request->nominal;
      $batas_bayar = $request->batas_bayar;
      for($count = 0; $count < count($rombel_id); $count++)
      {
       $data = array(
        'rombel_id' => $rombel_id[$count],
        'rincian'  => $rincian[$count],
        'jenis_kelamin'  => $jenis_kelamin[$count],
        'nominal'  => $nominal[$count],
        'batas_bayar'  => $batas_bayar[$count]
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
    public function edit ($id_tagihan)
    {
       $tagihan = \App\Tagihan::find($id_tagihan);
       return view('/pembayaran/tagihan/edit', compact('tagihan'));
    }

    public function update (Request $request, $id_tagihan)
    {
       $request->validate([
          'nominal' => 'numeric',
       ]);
       $tagihan = \App\Tagihan::find($id_tagihan);
       $tagihan->update($request->all());
       $tagihan->save();
       return redirect('/pembayaran/tagihan/index') ->with('sukses','Data Rincian Tagihan Berhasil Diedit');
    }

     //function untuk hapus
     public function delete($id)
     {
         $tagihan=\App\Tagihan::find($id);
         $tagihan->delete();
         return redirect('/pembayaran/tagihan/index') ->with('sukses','Data Rincian Tagihan Berhasil Dihapus');
     }
}
