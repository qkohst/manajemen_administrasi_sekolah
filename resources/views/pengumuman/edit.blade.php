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
        <form action="/pengumuman/{{$pengumuman->id}}/update" method="POST">
            <h3><i class="nav-icon fas fa-bullhorn my-1 btn-sm-1"></i> Edit Data Pengumuman</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-4">
                        <label for="judul">Judul Ppengumuman</label>
                        <input name="judul" type="text" class="form-control bg-light" id="judul"
                            placeholder="Judul Pengumuman" value="{{$pengumuman->judul}}" required>
                </div>
            </div>
            <div class="row">
                    <div class="col-12">
                        <label for="isi">Isi Pengumuman</label>
                        <textarea name="isi" class="form-control bg-light" id="isi" rows="7"
                            placeholder="Isi Pengumuman" required>{{$pengumuman->isi}}</textarea>
                    </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/pengumuman/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection
