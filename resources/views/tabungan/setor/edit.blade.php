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
        <form action="/tabungan/setor/{{$setor->id}}/update" method="POST">
            <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Edit Data Setor Tunai</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    <label for="pesdik_id">Nama Peserta Didik</label>
                    <input value="{{$setor->pesdik->nisn}} {{$setor->pesdik->nama}}" name="jumlah" type="text" class="form-control bg-disabled" id="jumlah" disabled>
                    <label for="tanggal">Tanggal Setoran</label>
                    <input value="{{$setor->tanggal}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="jumlah">Jumlah</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input value="{{$setor->jumlah}}" name="jumlah" type="number" class="form-control" id="jumlah" placeholder="Jumlah" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Keterangan" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{$setor->keterangan}}</textarea>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/tabungan/setor/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection