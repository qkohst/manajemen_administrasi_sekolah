@extends('layouts.master')

@section('content')
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
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <form action="{{ route('disposisi.store', $smasuk) }}" method="POST">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Tambah Disposisi</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="tujuan">Tujuan</label>
                    <input value="{{old('tujuan')}}" name="tujuan" type="text" class="form-control bg-light" placeholder="Tujuan" required>
                    <label for="isi">Isi</label>
                    <input value="{{old('isi')}}" name="isi" type="text" class="form-control bg-light" placeholder="Isi" required>
                    <label for="sifat">Sifat</label>
                    <input value="{{old('sifat')}}" name="sifat" type="text" class="form-control bg-light" placeholder="Sifat" required>
                </div>
                <div class="col-6">
                    <label for="batas_waktu">Batas Waktu</label>
                    <input value="{{old('batas_waktu')}}" name="batas_waktu" type="date" class="form-control bg-light" required>
                    <label for="catatan">Catatan</label>
                    <input value="{{old('catatan')}}" name="catatan" type="text" class="form-control bg-light" placeholder="Catatan" required>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="{{ route('disposisi.index', $smasuk) }}" role="button"><i
                    class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
