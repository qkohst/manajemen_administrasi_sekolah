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
                <h3><i class="nav-icon fas fa-envelope-open my-1 btn-sm-1"></i> Agenda Surat Keluar</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <span style="float: right">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="{{route('suratkeluar.downloadexcel')}}"
                    role="button"><i class="fas fa-file-excel"></i> Download Excel</a>
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="/suratkeluar/agendakeluarcetak_pdf" target="_blank"
                    role="button"><i class="fas fa-print"></i> Cetak</a>
            </span>
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-head-fixed" id='tabelAgendaKeluar'>
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
                            <?php $no = 0;?>
                            @foreach($data_suratkeluar as $suratkeluar)
                            <?php $no++ ;?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$suratkeluar->isi}}</td>
                                <td>{{$suratkeluar->tujuan_surat}}</td>
                                <td>{{$suratkeluar->kode}}</td>
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
