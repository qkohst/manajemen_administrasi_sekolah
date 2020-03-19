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
            <h3><i class="nav-icon fas fa-money-bill-alt my-1 btn-sm-1"></i> Pemasukan Sekolah</h3>
            <hr>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-header bg-dark p-0">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><h6 class="card-header bg-dark"><i class="fas fa-money-bill-alt"></i> TAMBAH PEMASUKAN</h6></li>
                                <li class="nav-item"><a class="nav-link active btn-sm my-1 mr-sm-1" data-toggle="modal" href="#kategori"><i class="fas fa-plus"></i> Kategori</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                        <form action="/keuangan/pemasukan/tambah" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group row">
                                                <label for="kategori_id">Pilih Kategori</label>
                                                <select name="kategori_id" id="kategori_id" class="form-control bg-light" required>
                                                    <option value="">-- Pilih Kategori Pemasukan --</option>
                                                    <option value="1">Bosnas</option>
                                                    <option value="2">Bosda</option>
                                                    <option value="3">Sumber Lain</option>
                                                </select>
                                        </div>
                                        <div class="form-group row">
                                                <label for="tanggal">Tanggal Uang Masuk</label>
                                                <input value="{{old('tanggal')}}" name="tanggal" type="date" class="form-control bg-light"
                                                    id="tanggal" required>
                                        </div>
                                        <div class="form-group row">
                                                <label for="jumlah">Jumlah</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input value="{{old('jumlah')}}" name="jumlah" type="text" class="form-control" id="jumlah" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="2"
                                                    placeholder="Keterangan" required>{{old('keterangan')}}</textarea>
                                        </div>
                                        <hr><hr>
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                                    </form>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                            <div class="card">
                            <h6 class="card-header bg-dark"><i class="fas fa-money-bill-alt"></i> REKAP DATA PEMASUKAN</h6>
                            <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-head-fixed" id='tabelAgendaMasuk'>
                                            <thead>
                                                <tr class="bg-light">
                                                    <th>No.</th>
                                                    <th>Tanggal</th>
                                                    <th>Jumlah</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;?>
                                                @foreach($data_pemasukan as $pemasukan)
                                                <?php $no++ ;?>
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$pemasukan->tanggal}}</td>
                                                    <td>Rp.{{$pemasukan->jumlah}},00</td>
                                                    <td>{{$pemasukan->keterangan}}</td>
                                                    <td>
                                                    <a href="/pemasukan/{{$pemasukan->id}}/edit"
                                                        class="btn btn-primary btn-sm my-1 mr-sm-1"><i
                                                            class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                                    @if (auth()->user()->role == 'admin')
                                                    <a href="/keuangan/pemasukan/{{$pemasukan->id}}/delete"
                                                        class="btn btn-danger btn-sm my-1 mr-sm-1"
                                                        onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
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
                    <!-- Modal Tambah -->
                    <div class="modal fade" id="kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i
                                            class="nav-icon fas fa-layer-group my-1 btn-sm-1"></i> Tambah Kategori Pemasukan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="#" method="POST">
                                        {{csrf_field()}}
                                        <div class="row">
                                                <label for="nama_pemasukan">Nama Pemasukan</label>
                                                <input value="{{old('nama_pemasukan')}}" name="nama_pemasukan" type="text" class="form-control bg-light"
                                                    id="nama_pemasukan" placeholder="Nama Pemasukan" required>
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
