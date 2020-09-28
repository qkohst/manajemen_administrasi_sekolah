@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Tarik Tunai</h4>
        <hr>
        <section class="content">
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
            <div class="callout callout-danger alert alert-danger alert-dismissible fade show" role="alert">
                <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h6 class="card-header bg-light p-3"><i class="fas fa-credit-card"></i> TAMBAH TARIK TUNAI</h6>
                            <div class="card-body">
                                <form action="/tabungan/tarik/tambah" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label for="pesdik_id">Pilih Peserta Didik</label>
                                        <select name="pesdik_id" id="pesdik_id" class="form-control select2bs4" required>
                                            <option value="">-- Pilih Peserta Didik --</option>
                                            @foreach($data_pesdik as $pesdik)
                                            <option value="{{$pesdik->pesdik_id}}">{{$pesdik->pesdik->nisn}} {{$pesdik->pesdik->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal">Tanggal Penarikan</label>
                                        <input value="{{old('tanggal')}}" name="tanggal" type="date" class="form-control bg-light" id="tanggal" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
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
                                        <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Ketikkan Tanda ( - ) Jika Tidak Ada Keterangan" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header bg-light p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#tarik" data-toggle="tab"><i class="fas fa-credit-card"></i> Rekap Data Tarik Tunai</a></li>
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#pesdik" data-toggle="tab"><i class="fas fa-child"></i> Data Peserta Didik</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="tarik">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>No. Trans</th>
                                                                <th>Nama Pesdik</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Keterangan</th>
                                                                <th>Petugas</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_tarik as $tarik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>TT0{{$tarik->id}}</td>
                                                                <td>{{$tarik->pesdik->nama}}</td>
                                                                <td>{{$tarik->tanggal}}</td>
                                                                <td>@currency($tarik->jumlah),00</td>
                                                                <td>{{$tarik->keterangan}}</td>
                                                                <td>{{$tarik->users->name}}</td>
                                                                <td>
                                                                    <a href="/tabungan/tarik/{{$tarik->id}}/cetakprint" target="_blank" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-print"></i> Cetak</a>
                                                                    <a href="/tabungan/tarik/{{$tarik->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                                                    @if (auth()->user()->role == 'admin')
                                                                    <a href="/tabungan/tarik/{{$tarik->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
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

                                    <div class="tab-pane" id="pesdik">
                                        <div class="row">
                                            <div class="row table-responsive">
                                                <div class="col-12">
                                                    <table class="table table-hover table-head-fixed" id='tabelAgendaKeluar'>
                                                        <thead>
                                                            <tr class="bg-light">
                                                                <th>No.</th>
                                                                <th>NISN </th>
                                                                <th>Nama Pesdik</th>
                                                                <th>Rombel</th>
                                                                <th>Saldo Tabungan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 0; ?>
                                                            @foreach($data_pesdik as $pesdik)
                                                            <?php $no++; ?>
                                                            <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$pesdik->pesdik->nisn}}</td>
                                                                <td>{{$pesdik->pesdik->nama}}</td>
                                                                <td>{{$pesdik->pesdik->rombel->nama_rombel}}</td>
                                                                <?php
                                                                $id = $pesdik->pesdik->id;
                                                                $total_setor = DB::table('setor')->where('setor.pesdik_id', '=', $id)
                                                                    ->sum('setor.jumlah');
                                                                $total_tarik = DB::table('tarik')->where('tarik.pesdik_id', '=', $id)
                                                                    ->sum('tarik.jumlah');
                                                                ?>
                                                                <td>@currency($total_setor-$total_tarik),00</td>
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
                </div><!-- /.container-fluid -->
        </section>
    </div>
</section>
@endsection