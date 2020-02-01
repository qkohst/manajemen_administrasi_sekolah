@extends('layouts.master')

@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <h3><i class="nav-icon fas fa-warehouse my-1 btn-sm-1"></i> Profil Instansi</h3>
            <hr>
            @if ($instansi->count() >= 1)
                @foreach ($instansi as $item_ins)
                <div class="row">
                    <div class="col-md-6">
                        <h4>Nama Instansi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->nama }}</h4>
                        <h4>Alamat Instansi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->alamat }}</h4>
                        <h4>Pimpinan Instansi &nbsp;&nbsp;: {{ $item_ins->pimpinan }}</h4>
                        <h4>Email Instansi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->email }}</h4>
                        <h4> Logo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            <img src="{{ asset($item_ins->file) }}" class="img-fluid" style="width: 100px" alt="thumbnail">
                        </h4>
                        <br>
                        <a class="btn btn-primary btn-md" href="{{ route('instansi.edit', $item_ins->id) }}" role="button"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-md-6">
                <a class="btn btn-primary btn-md" href="{{ route('instansi.create') }}" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
                </div>
            @endif
    </section>
@endsection
