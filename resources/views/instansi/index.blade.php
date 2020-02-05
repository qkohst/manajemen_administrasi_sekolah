@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <h3><i class="nav-icon fas fa-warehouse my-1 btn-sm-1"></i> Profil Instansi</h3>
    <hr>
    @if ($instansi->count() >= 1)
    @foreach ($instansi as $item_ins)
    <div class="row">
        <div class="col-md-12">
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-9">
                        <h3 class="font-weight-bold">{{ $item_ins->nama }}</h3>
                        <ul class="ml-4 mb-0 fa-ul text-black">
                            <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-user-tie"></i></span>
                                <h4>Pimpinan
                                    &nbsp;: {{ $item_ins->pimpinan }}</h4>
                            </li>
                            <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-map-marker-alt"></i></span>
                                <h4>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->alamat }}</h4>
                            </li>
                            <li><span class="fa-li"><i class="fas fa-lg fa-at"></i></span>
                                <h4>Email
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->email }}</h4>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ asset($item_ins->file) }}" data-toggle="lightbox" data-title="Lihat Logo Instansi">
                        <center>
                            <img id="logo" src="{{ asset($item_ins->file) }}" alt="Logo Instansi" class="rounded"
                                width="200"><br>
                        </center>
                    </a>
                </div>
            </div>
            <hr>
            <div class="col-12 text-center">
                <a class="btn btn-primary" href="{{ route('instansi.edit', $item_ins->id) }}" role="button"><i
                        class="fas fa-edit"></i> Edit Data Instansi</a>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="col-md-6">
        <a class="btn btn-primary btn-md" href="{{ route('instansi.create') }}" role="button"><i
                class="fas fa-plus"></i> Setting Data Instansi</a>
    </div>
    @endif
</section>
@endsection
