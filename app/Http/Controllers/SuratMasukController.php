<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use App\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Exports\SuratMasukExport;



class SuratmasukController extends Controller
{
    public function index()
    {
        $data_suratmasuk = \App\SuratMasuk::orderByRaw('created_at DESC')->get();
        return view('suratmasuk.index', ['data_suratmasuk' => $data_suratmasuk]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $data_klasifikasi = \App\Klasifikasi::orderByRaw('kode ASC')->get();
        return view('suratmasuk/create', ['data_klasifikasi' => $data_klasifikasi]);
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'filemasuk'  => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat'   => 'unique:suratmasuk|min:5',
            'isi'        => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratmasuk = new SuratMasuk();
        $suratmasuk->no_surat   = $request->input('no_surat');
        $suratmasuk->asal_surat = $request->input('asal_surat');
        $suratmasuk->isi        = $request->input('isi');
        $suratmasuk->klasifikasi_id       = $request->input('klasifikasi_id');
        $suratmasuk->tgl_surat  = $request->input('tgl_surat');
        $suratmasuk->tgl_terima = $request->input('tgl_terima');
        $suratmasuk->keterangan = $request->input('keterangan');
        $file                   = $request->file('filemasuk');
        $fileName   = 'S_Masuk-' . $file->getClientOriginalName();
        $file->move('datasuratmasuk/', $fileName);
        $suratmasuk->filemasuk  = $fileName;
        $suratmasuk->users_id = Auth::id();
        $suratmasuk->save();
        return redirect('/suratmasuk/index')->with("sukses", "Data Surat Masuk Berhasil Ditambahkan");
    }

    //function untuk melihat file
    public function tampil($id_suratmasuk)
    {
        $suratmasuk = \App\SuratMasuk::find($id_suratmasuk);
        return view('suratmasuk/tampil', ['suratmasuk' => $suratmasuk]);
    }

    //function untuk download file
    public function downfunc()
    {

        $downloads = DB::table('suratmasuk')->get();
        return view('suratmasuk.tampil', compact('downloads'));
    }

    //function untuk masuk ke view edit
    public function edit($id_suratmasuk)
    {
        $data_klasifikasi = \App\Klasifikasi::orderByRaw('kode ASC')->get();
        $suratmasuk = \App\SuratMasuk::find($id_suratmasuk);
        return view('suratmasuk/edit', ['suratmasuk' => $suratmasuk], ['data_klasifikasi' => $data_klasifikasi]);
    }
    public function update(Request $request, $id_suratmasuk)
    {
        $request->validate([
            'filemasuk' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratmasuk = \App\SuratMasuk::find($id_suratmasuk);
        $suratmasuk->update($request->all());
        //Untuk Update File
        if ($request->hasFile('filemasuk')) {
            $request->file('filemasuk')->move('datasuratmasuk/', 'S_Masuk-' . $request->file('filemasuk')->getClientOriginalName());
            $suratmasuk->filemasuk = 'S_Masuk-' . $request->file('filemasuk')->getClientOriginalName();
            $suratmasuk->save();
        }
        return redirect('suratmasuk/index')->with('sukses', 'Data Surat Masuk Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_suratmasuk)
    {
        $suratmasuk = \App\SuratMasuk::find($id_suratmasuk);
        $suratmasuk->delete();
        return redirect('suratmasuk/index')->with('sukses', 'Data Surat Masuk Berhasil Dihapus');
    }

    //Function Untuk Agenda Surat Masuk
    public function agenda(Request $request)
    {
        $tgl1 = \App\SuratMasuk::first();
        $tgl2 = \App\SuratMasuk::latest()->first();
        $tgl_awal = $tgl1->tgl_terima;
        $tgl_akhir = $tgl2->tgl_terima;
        $data_suratmasuk = \App\SuratMasuk::orderByRaw('created_at DESC')->get();
        return view('suratmasuk.agenda', compact('data_suratmasuk', 'tgl_awal', 'tgl_akhir'));
    }

    public function filter_agenda(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_suratmasuk = \App\SuratMasuk::whereBetween('tgl_terima', [$tgl_awal, $tgl_akhir])->orderByRaw('created_at DESC')->get();
        return view('suratmasuk.agenda', compact('data_suratmasuk', 'tgl_awal', 'tgl_akhir'));
    }

    public function cetakagenda(Request $request)
    {
        $inst = Instansi::first();
        $tgl1 = $request->input('tgl_a');
        $tgl2 = $request->input('tgl_b');

        $data_suratmasuk = \App\SuratMasuk::whereBetween('tgl_terima', [$tgl1, $tgl2])->orderByRaw('created_at DESC')->get();
        return view('suratmasuk.cetakagenda', compact('inst', 'data_suratmasuk', 'tgl1', 'tgl2'));
    }

    public function agendamasukdownload_excel()
    {
        $namafile = 'Agenda_surat_masuk_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new SuratMasukExport, $namafile);
    }

    //Function Untuk Galeri Surat Masuk
    public function galeri(Request $request)
    {
        $data_suratmasuk = \App\SuratMasuk::orderByRaw('created_at DESC')->get();
        return view('suratmasuk.galeri', ['data_suratmasuk' => $data_suratmasuk]);
    }
}
