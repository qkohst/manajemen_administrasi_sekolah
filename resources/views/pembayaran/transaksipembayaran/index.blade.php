@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Transaksi Pembayaran Siswa</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if(session('warning'))
                        <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
                            <h5><i class="fas fa-info"></i> Informasi :</h5>
                            {{session('warning')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="card">
                            <h6 class="card-header bg-secondary p-2"><i class="fas fa-search"></i> CARI DATA SISWA</h6>
                            <div class="card-body bg-light">
                                <form action="/pembayaran/transaksipembayaran/cari_pesdik" method="POST">
                                    {{csrf_field()}}
                                    <select name="cari_pesdik" id="cari_pesdik" class="form-control select2bs4" onchange="this.form.submit();">
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach($data_pesdik as $pesdik)
                                        <option value="{{$pesdik->id}}">{{$pesdik->nisn}}/{{$pesdik->induk}} - {{$pesdik->nama}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
</section>
@endsection