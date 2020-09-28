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
        <form action="/suratmasuk/{{$suratmasuk->id}}/update" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Edit Surat Masuk</h4>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="nomorsurat">Nomor Surat</label>
                    <input name="no_surat" type="text" class="form-control bg-light" id="nomorsurat" placeholder="Nomor Surat" value="{{$suratmasuk->no_surat}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="asalsurat">Asal Surat</label>
                    <input name="asal_surat" type="text" class="form-control bg-light" id="asalsurat" placeholder="Asal Surat" value="{{$suratmasuk->asal_surat}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="isisurat">Isi Ringkas</label>
                    <textarea name="isi" class="form-control bg-light" id="isisurat" rows="3" placeholder="Isi Ringkas Surat Masuk" value="{{$suratmasuk->isi}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{$suratmasuk->isi}}</textarea>
                    <label for="klasifikasi_id">Kode Klasifikasi</label>
                    <select name="klasifikasi_id" class="form-control my-1 mr-sm-2" id="klasifikasi_id" disabled>
                        <option value="{{$suratmasuk->klasifikasi_id}}">{{$suratmasuk->klasifikasi->nama}} ({{$suratmasuk->klasifikasi->kode}})</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tglsurat">Tanggal Surat</label>
                    <input name="tgl_surat" type="date" class="form-control bg-light" id="tglsurat" value="{{$suratmasuk->tgl_surat}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="tglditerima">Tanggal Diterima</label>
                    <input name="tgl_terima" type="date" class="form-control bg-light" id="tglditerima" value="{{$suratmasuk->tgl_terima}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="keterangan">Keterangan</label>
                    <input name="keterangan" type="text" class="form-control bg-light" id="keterangan" placeholder="Keterangan" value="{{$suratmasuk->keterangan}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">File</label>
                        <input name="filemasuk" type="file" class="form-control-file" id="exampleFormControlFile1" value="{{$suratmasuk->filemasuk}}">
                        <small id="exampleFormControlFile1" class="text-warning">
                            Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
                        </small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/suratmasuk/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection