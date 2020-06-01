@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('sukses')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
        <form action="/keuangan/pengeluaran/{{$pengeluaran->id}}/update" method="POST">
            <h3><i class="nav-icon fas fa-money-bill my-1 btn-sm-1"></i> Edit Data Pengeluaran</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="kategori_id">Nama Kategori</label>
                    <select name="kategori_id" class="form-control bg-light" id="kategori_id" required>
                        <option value="{{$pengeluaran->kategori_id}}">{{$pengeluaran->kategori->nama_kategori}}</option>
                        @foreach($data_kategori as $kategori)
                        <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                        @endforeach
                    </select>
                    <label for="tanggal">Tanggal Uang Masuk</label>
                    <input value="{{$pengeluaran->tanggal}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required>
                    <label for="jumlah">Jumlah</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input value="{{$pengeluaran->jumlah}}" name="jumlah" type="text" class="form-control bg-light" id="jumlah" placeholder="Jumlah" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Keterangan" required>{{$pengeluaran->keterangan}}</textarea>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/keuangan/pengeluaran/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection