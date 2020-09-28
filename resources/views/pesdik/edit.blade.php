@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
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
        <form action="/pesdik/{{$pesdik->id}}/update" method="POST" enctype="multipart/form-data">
            <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Edit Data Peserta Didik</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="nama">Nama Siswa</label>
                    <input value="{{$pesdik->nama}}" name="nama" type="text" class="form-control" id="nama" placeholder="Nama Siswa" disabled>
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                        <option value="Laki-Laki" @if ($pesdik->jenis_kelamin == 'Laki-Laki') selected @endif>Laki-Laki</option>
                        <option value="Perempuan" @if ($pesdik->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                    </select>
                    <label for="nisn">NISN</label>
                    <input value="{{$pesdik->nisn}}" name="nisn" type="number" class="form-control" id="nisn" placeholder="NISN" disabled>
                    <label for="induk">Induk</label>
                    <input value="{{$pesdik->induk}}" name="induk" type="number" class="form-control" id="induk" placeholder="Induk" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                </div>
                <div class="col-md-6">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input value="{{$pesdik->tempat_lahir}}" name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input value="{{$pesdik->tanggal_lahir}}" name="tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="jenis_pendaftaran">Jenis Pendaftaran</label>
                    <select name="jenis_pendaftaran" id="jenis_pendaftaran" class="form-control" disabled>
                        <option value="Siswa Baru" @if ($pesdik->jenis_pendaftaran == 'Siswa Baru') selected @endif>Siswa Baru</option>
                        <option value="Pindahan" @if ($pesdik->jenis_pendaftaran == 'Pindahan') selected @endif>Pindahan</option>
                        <option value="Mengulang" @if ($pesdik->jenis_pendaftaran == 'Mengulang') selected @endif>Mengulang</option>
                    </select>
                    <label for="tanggal_masuk">Tanggal Masuk</label>
                    <input value="{{$pesdik->tanggal_masuk}}" name="tanggal_masuk" type="date" class="form-control" id="tanggal_masuk" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/pesdik/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection