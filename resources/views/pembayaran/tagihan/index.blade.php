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
        <h4><i class="nav-icon fas fa-money-check-alt my-1 btn-sm-1"></i> Rincian Tagihan Pembayaran</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i>
                            Tambah Data</a>
                        <br>
                        <form action="/pembayaran/tagihan/filter" method="POST">
                            {{csrf_field()}}
                            <select name="rombel_filter" id="rombel_filter" class="form-control select2bs4" onchange="this.form.submit();">
                                <option value="">-- Lihat Rincian Tagihan Berdasarkan Rombel --</option>
                                @foreach($daftar_rombel as $list_rombel)
                                <option value="{{ $list_rombel->rombel_id }}">{{$list_rombel->rombel->nama_rombel}} {{$list_rombel->rombel->tapel->tahun}} {{$list_rombel->rombel->tapel->semester}}</option>
                                @endforeach
                            </select>
                            <br>
                        </form>
                    </div>
                    <div class="row table-responsive">
                        <div class="col-12">
                            <table class="table table-hover table-head-fixed" id='tabelTagihan'>
                                <thead>
                                    <tr class="bg-light">
                                        <th>No.</th>
                                        <th>Rombel</th>
                                        <th>Rincian</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nominal</th>
                                        <th>Batas Waktu Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach($data_tagihan as $tagihan)
                                    <?php $no++; ?>
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$tagihan->rombel->nama_rombel}} {{$tagihan->rombel->tapel->tahun}} {{$tagihan->rombel->tapel->semester}}</td>
                                        <td>{{$tagihan->rincian}}</td>
                                        <td>{{$tagihan->jenis_kelamin}}</td>
                                        <td>@currency($tagihan->nominal),00</td>
                                        <td>{{$tagihan->batas_bayar}}</td>
                                        <td>
                                            <a href="/pembayaran/tagihan/{{$tagihan->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                            @if (auth()->user()->role == 'admin')
                                            <a href="/pembayaran/tagihan/{{$tagihan->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                                Hapus</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
</section>
@endsection