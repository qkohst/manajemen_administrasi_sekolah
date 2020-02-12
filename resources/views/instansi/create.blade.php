@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('instansi.store') }}" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-warehouse my-1 btn-sm-1"></i> Profil Instansi</h3>
            <hr>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-6">
                    <label for="nama">Nama Instansi</label>
                    <input name="nama" type="text" class="form-control bg-light" id="nama" placeholder="Nama Instansi"
                        required>
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control bg-light" id="alamat" rows="3" placeholder="Alamat"
                        required></textarea>
                </div>
                <div class="col-6">
                    <label for="pimpinan">Nama Pimpinan</label>
                    <input name="pimpinan" type="text" class="form-control bg-light" id="pimpinan"
                        placeholder="Nama Pimpinan" required>
                    <label for="email">Email Instansi</label>
                    <input name="email" type="email" class="form-control bg-light" id="email"
                        placeholder="Email Instansi" required>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">File</label>
                        <input name="file" type="file" class="form-control-file" id="exampleFormControlFile1" required>
                        <small id="exampleFormControlFile1" class="text-danger">
                            Format file yang diperbolehkan hanya *.JPG, *.PNG dan ukuran maksimal file 2 MB. Disarankan
                            gambar berbentuk kotak atau lingkaran!
                        </small>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/instansi" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
