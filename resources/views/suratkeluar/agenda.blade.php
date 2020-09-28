@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon fas fa-envelope-open my-1 btn-sm-1"></i> Agenda Surat Keluar</h4>
                <hr>
            </div>
        </div>
        <form action="/suratkeluar/filter_agenda" method="POST" class="row input-daterange">
            {{csrf_field()}}
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="tgl_awal" class="col-sm-3 col-form-label">Dari Tgl</label>
                    <div class="col-sm-8">
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="tgl_awal" class="col-sm-3 col-form-label">Sampai Tgl</label>
                    <div class="col-sm-8">
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" onchange="this.form.submit();" />
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <a class="btn btn-success btn-sm my-1 mr-sm-1" href="agenda" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>

            </div>
        </form>
        <div class="row">
            <div class="col-md-8">
                <h6>Agenda surat keluar dari tanggal pencatatan {{$tgl_awal}} sampai tanggal {{$tgl_akhir}}</h6>
            </div>
            <div class="col-md-4">
                <form action="/suratkeluar/cetakagenda" method="POST" target="_blank">
                    {{csrf_field()}}
                    <input name="tgl_a" type="text" class="d-none" id="tgl_a" value="{{$tgl_awal}}">
                    <input name="tgl_b" type="text" class="d-none" id="tgl_b" value="{{$tgl_akhir}}">

                    <button type="submit" class="btn btn-primary btn-sm my-1 mr-1 float-right"><i class="fas fa-print"></i> Cetak</button>
                </form>
                <a class="btn btn-primary btn-sm my-1 mr-1 float-right" href="{{route('suratkeluar.downloadexcel')}}" role="button"><i class="fas fa-file-excel"></i> Download Excel</a>
            </div>

            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='agenda'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Isi Ringkas</th>
                                <th>Tujuan Surat</th>
                                <th>Kode</th>
                                <th>No. Surat</th>
                                <th>Tgl. Surat</th>
                                <th>Tgl. Catat</th>
                                <th>Pengelola</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data_suratkeluar as $suratkeluar)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$suratkeluar->isi}}</td>
                                <td>{{$suratkeluar->tujuan_surat}}</td>
                                <td>{{$suratkeluar->klasifikasi->kode}}</td>
                                <td>{{$suratkeluar->no_surat}}</td>
                                <td>{{$suratkeluar->tgl_surat}}</td>
                                <td>{{$suratkeluar->tgl_catat}}</td>
                                <td>{{$suratkeluar->users->name}}</td>
                                <td>{{$suratkeluar->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection