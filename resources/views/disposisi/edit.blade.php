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
        <form action="{{ route('disposisi.update', [$smasuk, $disp->id]) }}" method="get">
            <h4><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Edit Disposisi</h4>
            <hr />
            {{csrf_field()}}
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <label for="tujuan">Tujuan</label>
                    <input name="tujuan" type="text" class="form-control bg-light" placeholder="Tujuan" value="{{ $disp->tujuan }}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="isi">Isi</label>
                    <input name="isi" type="text" class="form-control bg-light" placeholder="Isi" value="{{ $disp->isi }}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="sifat">Sifat</label>
                    <input name="sifat" type="text" class="form-control bg-light" placeholder="Sifat" value="{{ $disp->sifat }}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                </div>
                <div class="col-md-6">
                    <label for="batas_waktu">Batas Waktu</label>
                    <input name="batas_waktu" type="date" class="form-control bg-light" value="{{ $disp->batas_waktu }}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="catatan">Catatan</label>
                    <input name="catatan" type="text" class="form-control bg-light" placeholder="Catatan" value="{{ $disp->catatan }}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="{{ route('disposisi.index', $smasuk) }}" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection