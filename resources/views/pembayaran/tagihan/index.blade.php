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
            <h3><i class="nav-icon fas fa-money-bill-alt my-1 btn-sm-1"></i> Rincian Tagihan Pembayaran</h3>
            <hr>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active btn-sm" href="#tagihan" data-toggle="tab"><i class="fas fa-money-bill-alt"></i> Rekap Tagihan Pembayaran</a></li>
                                <li class="nav-item"><a class="nav-link btn-sm" href="#kategori" data-toggle="tab"><i class="fas fa-plus"></i> Tambah Tagihan Pembayaran</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="tagihan">
                                <div class="row">
                                    <div class="row table-responsive">
                                        <div class="col-12">
                                            <table class="table table-head-fixed" id='tabelAgendaMasuk'>
                                                <thead>
                                                    <tr class="bg-light">
                                                        <th>No.</th>
                                                        <th>Rombel</th>
                                                        <th>Rincian</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Nominal</th>
                                                        <th>Batas Pembayaran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;?>
                                                    @foreach($data_tagihan as $tagihan)
                                                    <?php $no++ ;?>
                                                    <tr>
                                                        <td>{{$no}}</td>
                                                        <td>{{$tagihan->rombel->nama_rombel}} {{$tagihan->rombel->tapel->tahun}} {{$tagihan->rombel->tapel->semester}}</td>
                                                        <td>{{$tagihan->rincian}}</td>
                                                        <td>{{$tagihan->jenis_kelamin}}</td>
                                                        <td>@currency($tagihan->nominal),00</td>
                                                        <td>{{$tagihan->batas_bayar}}</td>
                                                        <td>
                                                        <a href="/pembayaran/tagihan/{{$tagihan->id}}/edit"
                                                            class="btn btn-primary btn-sm my-1 mr-sm-1"><i
                                                                class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                                        @if (auth()->user()->role == 'admin')
                                                        <a href="/pembayaran/tagihan/{{$tagihan->id}}/delete"
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

                                <div class="tab-pane" id="kategori">
                                <div class="row">
                                    <div class="col-4">
                                        <select name="rombel_id[]" id="rombel_id[]" class="form-control select2bs4" required>
                                            <option value="">-- Pilih Rombel --</option>
                                                @foreach($data_rombel as $rombel)
                                                <option value="{{$rombel->id}}">{{$rombel->nama_rombel}} {{$rombel->tapel->tahun}} {{$rombel->tapel->semester}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <a  href="#" class="btn btn-primary mr-sm-1"
                                            onclick="addRow('dataTable')"><i class="nav-icon fas fa-plus"></i>
                                            Tambah Baris</a>
                                        <a href="#" class="btn btn-danger mr-sm-1"
                                            onclick="deleteRow('dataTable'), confirm('Hapus Baris Tabel ?')"><i class="nav-icon fas fa-trash"></i>
                                            Hapus Baris</a>
                                    </div>
                                    <div class="row table-responsive">
                                        <div class="col-12">
                                        <table id="dataTable" class="table table-head-fixed">
                                            <thead>
                                                    <tr>
                                                        <th width="40px">Pilih</th>
                                                        <th width="150px">Jenis Kelamin</th>
                                                        <th>Rincian</th>
                                                        <th width="250px">Nominal</th>
                                                        <th width="200px">Batas Pembayaran</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input name="pilih" type="checkbox"/></td>
                                                    <td>
                                                        <select id="jenis_kelamin[]" name="jenis_kelamin[]"  class="form-control" required>
                                                            <option value="Semua" selected="selected">
                                                                Semua
                                                            </option>
                                                            <option value="Laki-Laki">
                                                                Laki-Laki
                                                            </option>
                                                            <option value="Perempuan">
                                                                Perempuan
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>  
                                                        <textarea name="rincian[]" class="form-control bg-light" id="rincian[]" rows="2"placeholder="Rincian Deskripsi Pembayaran">{{old('rincian')}}</textarea>
                                                    </td>
                                                    <td> 
                                                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input value="{{old('nominal[]')}}" name="nominal[]" type="text" class="form-control" id="nominal[]" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                        </div>
                                                    </td>
                                                    <td> 
                                                    <input value="{{old('batas_bayar[]')}}" name="batas_bayar[]" type="date" class="form-control bg-light" id="batas_bayar[]" required>
                                                    </td>
                                                </tr>
                                                <tr id="templateRow" style="display:none">
                                                    <td><input name="pilih" type="checkbox"/></td>
                                                    <td>
                                                        <select id="jenis_kelamin[]" name="jenis_kelamin[]"  class="form-control" required>
                                                            <option value="Semua" selected="selected">
                                                                Semua
                                                            </option>
                                                            <option value="Laki-Laki">
                                                                Laki-Laki
                                                            </option>
                                                            <option value="Perempuan">
                                                                Perempuan
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>  
                                                        <textarea name="rincian[]" class="form-control bg-light" id="rincian[]" rows="2"placeholder="Rincian Deskripsi Pembayaran">{{old('rincian')}}</textarea>
                                                    </td>
                                                    <td> 
                                                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp.</span>
                                                        </div>
                                                        <input value="{{old('nominal[]')}}" name="nominal[]" type="text" class="form-control" id="nominal[]" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                        </div>
                                                    </td>
                                                    <td> 
                                                    <input value="{{old('batas_bayar[]')}}" name="batas_bayar[]" type="date" class="form-control bg-light" id="batas_bayar[]" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <button type="submit" class="btn btn-success"><i class="nav-icon fas fa-save"></i> SIMPAN</button>
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
                </div><!-- /.container-fluid -->
            </section>
    </div>
</section>
@endsection
