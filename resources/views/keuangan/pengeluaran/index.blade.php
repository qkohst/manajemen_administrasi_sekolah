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
        <h4><i class="nav-icon fas fa-money-bill my-1 btn-sm-1"></i> Pengeluaran Sekolah</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <h6 class="card-header p-3"><i class="fas fa-money-bill"></i> TAMBAH PENGELUARAN</h6>
                            <div class="card-body">
                                <form action="/keuangan/pengeluaran/tambah" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label for="kategori_id">Pilih Kategori</label>
                                        <select name="kategori_id" id="kategori_id" class="form-control bg-light" required oninvalid="this.setCustomValidity('Belum ada data yang dipilih !')" oninput="setCustomValidity('')">
                                            <option value="">-- Pilih Kategori Pengeluaran --</option>
                                            @foreach($data_kategori as $ktgr)
                                            <option value="{{$ktgr->id}}">{{$ktgr->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jumlah">Jumlah</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input value="{{old('jumlah')}}" name="jumlah" type="number" class="form-control" id="jumlah" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="2" placeholder="Keterangan" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#pengeluaran" data-toggle="tab"><i class="fas fa-money-bill"></i> Rekap Data Pengeluaran</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#kategori" data-toggle="tab"><i class="fas fa-layer-group"></i> Kategori Pengeluaran</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="pengeluaran">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Kategori</th>
                                                                <th>Keterangan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_pengeluaran as $pengeluaran)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$pengeluaran->created_at}}</td>
                                                                <td>@currency($pengeluaran->jumlah),00</td>
                                                                <td>{{$pengeluaran->kategori->nama_kategori}}</td>
                                                                <td>{{$pengeluaran->keterangan}}</td>
                                                                <td>
                                                                    <a href="/keuangan/pengeluaran/{{$pengeluaran->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                                                    @if (auth()->user()->role == 'admin')
                                                                    <a href="/keuangan/pengeluaran/{{$pengeluaran->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
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
                                    </div>

                                    <div class="tab-pane" id="kategori">
                                        <div>
                                            <div class="col">
                                                <a class="btn btn-primary btn-sm my-1 mr-sm-1" data-toggle="modal" href="#tambahKategori"><i class="fas fa-plus"></i> Tambah Kategori</a>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaKeluar'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>Nama Kategori</th>
                                                                @if (auth()->user()->role == 'admin')
                                                                <th>Aksi</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_kategori as $kategorikeluar)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$kategorikeluar->nama_kategori}}</td>
                                                                @if (auth()->user()->role == 'admin')
                                                                <td>
                                                                    <a href="/keuangan/pengeluaran/{{$kategorikeluar->id}}/deletekategori" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
                                                                        Hapus</a>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- Modal Tambah -->
                    <div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-layer-group my-1 btn-sm-1"></i> Tambah Kategori Pengeluaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/keuangan/pengeluaran/tambahkategori" method="POST">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <label for="nama_kategori">Nama Kategori</label>
                                            <input value="{{old('nama_kategori')}}" name="nama_kategori" type="text" class="form-control bg-light" id="nama_kategori" placeholder="Nama Kategori" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i>
                                            SIMPAN</button>
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