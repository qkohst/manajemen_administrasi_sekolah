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
                            <div class="col-8">
                            <h2 class="lead"><b>{{ $item_ins->nama }}</b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-primary">
                                <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-user-tie"></i></span> Pimpinan &nbsp;: {{ $item_ins->pimpinan }}</li>
                                <li class="my-3"><span class="fa-li"><i class="fas fa-lg fa-map-marker-alt"></i></span> Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->alamat }}</li>
                                <li><span class="fa-li"><i class="fas fa-lg fa-at"></i></span class=> Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $item_ins->email }}</li>
                            </ul>
                            </div>
                            <div class="col-4 text-center">
                                <a href="{{ asset($item_ins->file) }}" data-toggle="lightbox" data-title="Lihat Logo Instansi">
                                            <center>
                                            <img id="logo" src="{{ asset($item_ins->file) }}" alt="" class="img-circle img-fluid" width="200" height="200"><br>
                                            </center>
                                        </a>
                                <h2 class="lead">
                                   <b>Logo Instansi</b>
                                </h2>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="col-11 text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('instansi.edit', $item_ins->id) }}" role="button"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-md-6">
                <a class="btn btn-primary btn-md" href="{{ route('instansi.create') }}" role="button"><i class="fas fa-plus"></i> Setting Data Instansi</a>
                </div>
            @endif
    </section>
@endsection
