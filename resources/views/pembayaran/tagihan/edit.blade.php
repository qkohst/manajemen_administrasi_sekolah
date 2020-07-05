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
        <form action="/pembayaran/tagihan/{{$tagihan->id}}/update" method="POST">
            <h3><i class="nav-icon fas fa-money-check-alt my-1 btn-sm-1"></i> Edit Tagihan Pembayaran</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="rombel_id">Rombongan Belajar</label>
                    <input value="{{$tagihan->rombel->nama_rombel}} {{$tagihan->rombel->tapel->tahun}} {{$tagihan->rombel->tapel->semester}}" name="rombel_id" type="text" class="form-control bg-disabled" id="jumlah" disabled>
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control bg-light" id="jenis_kelamin" required>
                        <option value="Semua" @if ($tagihan->jenis_kelamin == 'Semua') selected @endif>Semua</option>
                        <option value="Laki-Laki" @if ($tagihan->jenis_kelamin == 'Laki-Laki') selected @endif>Laki-Laki</option>
                        <option value="Perempuan" @if ($tagihan->jenis_kelamin == 'Perempuan') selected @endif>Perempuan</option>
                    </select>
                    <label for="rincian">Rincian</label>
                    <textarea name="rincian" class="form-control bg-light" id="rincian" rows="2" placeholder="rincian" required>{{$tagihan->rincian}}</textarea>
                </div>
                <div class="col-6">
                    <label for="nominal">Nominal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input value="{{$tagihan->nominal}}" name="nominal" type="text" class="form-control bg-light" id="nominal" placeholder="nominal" required>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <label for="batas_bayar">Batas Waktu Pembayaran</label>
                    <input value="{{$tagihan->batas_bayar}}" name="batas_bayar" type="date" class="form-control bg-light" id="batas_bayar" required>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/pembayaran/tagihan/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection