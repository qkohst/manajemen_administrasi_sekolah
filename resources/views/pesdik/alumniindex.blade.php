@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
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
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon fas fa-user-graduate my-0 btn-sm-1"></i> Data Alumni</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>NISN</th>
                                <th>No. Induk</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Lulus</th>
                                <th>Melanjutkan Ke</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data_pesdikalumni as $pesdikalumni)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$pesdikalumni->pesdik->nama}}</td>
                                <td>{{$pesdikalumni->pesdik->jenis_kelamin}}</td>
                                <td>{{$pesdikalumni->pesdik->nisn}}</td>
                                <td>{{$pesdikalumni->pesdik->induk}}</td>
                                <td>{{$pesdikalumni->pesdik->tanggal_masuk}}</td>
                                <td>{{$pesdikalumni->tanggal_lulus}}</td>
                                <td>{{$pesdikalumni->melanjutkan_ke}}</td>
                                <td>{{$pesdikalumni->keterangan}}</td>
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