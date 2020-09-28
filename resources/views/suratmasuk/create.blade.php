@extends('layouts.master')

@section('content')
@if(session('sukses'))
<div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
    <h5><i class="fas fa-check"></i> Sukses :</h5>
    {{session('sukses')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('warning'))
<div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
    <h5><i class="fas fa-info"></i> Informasi :</h5>
    {{session('warning')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="callout callout-danger alert alert-danger alert-dismissible fade show">
    <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <form action="/suratmasuk/tambah" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Tambah Data Surat Masuk</h4>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="nomorsurat">Nomor Surat</label>
                    <input value="{{old('no_surat')}}" name="no_surat" type="text" class="form-control bg-light" id="nomorsurat" placeholder="Nomor Surat" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="asalsurat">Asal Surat</label>
                    <input value="{{old('asal_surat')}}" name="asal_surat" type="text" class="form-control bg-light" id="asalsurat" placeholder="Asal Surat" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="isisurat">Isi Ringkas</label>
                    <textarea name="isi" class="form-control bg-light" id="isisurat" rows="3" placeholder="Isi Ringkas Surat Masuk" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('isi')}}</textarea>
                    <label for="klasifikasi_id">Kode Klasifikasi</label>
                    <select name="klasifikasi_id" class="form-control my-1 mr-sm-2 bg-light" id="inlineFormCustomSelectPref" required oninvalid="this.setCustomValidity('Belum ada data yang dipilih !')" oninput="setCustomValidity('')">
                        <option value="">-- Pilih Klasifikasi Surat --</option>
                        @foreach($data_klasifikasi as $klasifikasi)
                        <option value="{{$klasifikasi->id}}">{{$klasifikasi->nama}} ( {{$klasifikasi->kode}} )
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tglsurat">Tanggal Surat</label>
                    <input value="{{old('tgl_surat')}}" name="tgl_surat" type="date" class="form-control bg-light" id="tglsurat" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="tglditerima">Tanggal Diterima</label>
                    <input value="{{old('tgl_terima')}}" name="tgl_terima" type="date" class="form-control bg-light" id="tglditerima" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="keterangan">Keterangan</label>
                    <input value="{{old('keterangan')}}" name="keterangan" type="text" class="form-control bg-light" id="keterangan" placeholder="Keterangan" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">File</label>
                        <input name="filemasuk" type="file" class="form-control-file" id="exampleFormControlFile1" required oninvalid="this.setCustomValidity('Belum ada file yang dipilih!')" oninput="setCustomValidity('')">
                        <small id="exampleFormControlFile1" class="text-danger">
                            Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
                        </small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection