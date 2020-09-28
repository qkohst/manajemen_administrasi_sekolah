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
        <form action="/tendik/{{$tendik->id}}/update" method="POST">
            <h4><i class="nav-icon fas fa-graduation-cap my-1 btn-sm-1"></i> Edit Data Tenaga Kependidikan</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="nama">Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control bg-light" id="nama" placeholder="Nama Lengkap" value="{{$tendik->nama}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control bg-light" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="Laki-Laki" @if ($tendik->jenis_kelamin == 'Laki-Laki') selected @endif>Laki-Laki
                        </option>
                        <option value="Perempuan" @if ($tendik->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                    </select>
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input name="tempat_lahir" type="text" class="form-control bg-light" id="tempat_lahir" placeholder="Tempat Lahir" value="{{$tendik->tempat_lahir}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="tanggal_lahir">Tanggal Surat</label>
                    <input name="tanggal_lahir" type="date" class="form-control bg-light" id="tanggal_lahir" value="{{$tendik->tanggal_lahir}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control bg-light" id="alamat" rows="2" placeholder="Alamat" value="{{$tendik->alamat}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{$tendik->alamat}}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="no_hp">Nomor HP</label>
                    <input name="no_hp" type="number" class="form-control bg-light" id="no_hp" placeholder="Nomor HP" value="{{$tendik->no_hp}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control bg-light" id="email" placeholder="Email" value="{{$tendik->email}}" required email oninvalid="this.setCustomValidity('Pastikan anda sudah mengisikan email dengan benar !')" oninput="setCustomValidity('')">
                    <label for="tugas">Bertugas Sebagai</label>
                    <select name="tugas" id="tugas" class="form-control bg-light" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="Pengelola Administrasi Surat" @if ($tendik->tugas == 'Pengelola Administrasi Surat') selected @endif>Pengelola Administrasi Surat</option>
                        <option value="Pengelola Administrasi Keuangan" @if ($tendik->tugas == 'Pengelola Administrasi Keuangan') selected @endif>Pengelola Administrasi Keuangan</option>
                        <option value="Pengelola Data Sekolah" @if ($tendik->tugas == 'Pengelola Data Sekolah') selected @endif>Pengelola Data Sekolah</option>
                    </select>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/tendik/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection