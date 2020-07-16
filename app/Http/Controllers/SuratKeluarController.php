<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use App\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\SuratKeluarExport;
use Maatwebsite\Excel\Facades\Excel;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $data_suratkeluar = \App\SuratKeluar::orderByRaw('created_at DESC')->get();
        return view('suratkeluar.index', ['data_suratkeluar' => $data_suratkeluar]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $data_klasifikasi = \App\Klasifikasi::orderByRaw('kode ASC')->get();
        return view('suratkeluar/create', ['data_klasifikasi' => $data_klasifikasi]);
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'filekeluar' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'unique:suratkeluar|min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratkeluar = new SuratKeluar();
        $suratkeluar->no_surat     = $request->input('no_surat');
        $suratkeluar->tujuan_surat = $request->input('tujuan_surat');
        $suratkeluar->isi          = $request->input('isi');
        $suratkeluar->klasifikasi_id         = $request->input('klasifikasi_id');
        $suratkeluar->tgl_surat    = $request->input('tgl_surat');
        $suratkeluar->tgl_catat    = $request->input('tgl_catat');
        $suratkeluar->keterangan   = $request->input('keterangan');
        $file                      = $request->file('filekeluar');
        $fileName   = 'S_keluar-' . $file->getClientOriginalName();
        $file->move('datasuratkeluar/', $fileName);
        $suratkeluar->filekeluar  = $fileName;
        $suratkeluar->users_id = Auth::id();
        $suratkeluar->save();
        return redirect('/suratkeluar/index')->with("sukses", "Data Surat Keluar Berhasil Ditambahkan");
    }

    //function untuk melihat file
    public function tampil($id_suratkeluar)
    {
        $suratkeluar = \App\SuratKeluar::find($id_suratkeluar);
        return view('suratkeluar/tampil', ['suratkeluar' => $suratkeluar]);
    }

    //function untuk download file
    public function downfunc()
    {

        $downloads = DB::table('suratkeluar')->get();
        return view('suratkeluar.tampil', compact('downloads'));
    }

    //function untuk ke view edit
    public function edit($id_suratkeluar)
    {
        $data_klasifikasi = \App\Klasifikasi::all();
        $suratkeluar = \App\SuratKeluar::find($id_suratkeluar);
        return view('suratkeluar/edit', ['suratkeluar' => $suratkeluar], ['data_klasifikasi' => $data_klasifikasi]);
    }
    public function update(Request $request, $id_suratkeluar)
    {
        $request->validate([
            'filekeluar' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratkeluar = \App\SuratKeluar::find($id_suratkeluar);
        $suratkeluar->update($request->all());
        //Untuk Update File
        if ($request->hasFile('filekeluar')) {
            $request->file('filekeluar')->move('datasuratkeluar/', 'S_Keluar-' . $request->file('filekeluar')->getClientOriginalName());
            $suratkeluar->filekeluar = 'S_Keluar-' . $request->file('filekeluar')->getClientOriginalName();
            $suratkeluar->save();
        }
        return redirect('suratkeluar/index')->with('sukses', 'Data Surat Keluar Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_suratkeluar)
    {
        $suratkeluar = \App\SuratKeluar::find($id_suratkeluar);
        $suratkeluar->delete();
        return redirect('suratkeluar/index')->with('sukses', 'Data Surat Keluar Berhasil Dihapus');
    }

    //Function Untuk Agenda Surat keluar
    public function agenda(Request $request)
    {
        $tgl1 = \App\SuratKeluar::first();
        $tgl2 = \App\SuratKeluar::latest()->first();
        $tgl_awal = $tgl1->tgl_catat;
        $tgl_akhir = $tgl2->tgl_catat;
        $data_suratkeluar = \App\SuratKeluar::orderByRaw('created_at DESC')->get();
        return view('suratkeluar.agenda', compact('data_suratkeluar', 'tgl_awal', 'tgl_akhir'));
    }

    public function filter_agenda(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_suratkeluar = \App\SuratKeluar::whereBetween('tgl_catat', [$tgl_awal, $tgl_akhir])->orderByRaw('created_at DESC')->get();
        return view('suratkeluar.agenda', compact('data_suratkeluar', 'tgl_awal', 'tgl_akhir'));
    }

    public function cetakagenda(Request $request)
    {
        $inst = Instansi::first();
        $tgl1 = $request->input('tgl_a');
        $tgl2 = $request->input('tgl_b');

        $data_suratkeluar = \App\SuratKeluar::whereBetween('tgl_catat', [$tgl1, $tgl2])->orderByRaw('created_at DESC')->get();
        return view('suratkeluar.cetakagenda', compact('inst', 'data_suratkeluar', 'tgl1', 'tgl2'));
    }

    public function agendakeluardownload_excel()
    {
        $namafile = 'Agenda_surat_keluar_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new SuratKeluarExport, $namafile);
    }

    public function galeri(Request $request)
    {
        $data_suratkeluar = \App\SuratKeluar::orderByRaw('created_at DESC')->get();
        return view('suratkeluar.galeri', ['data_suratkeluar' => $data_suratkeluar]);
    }
}
