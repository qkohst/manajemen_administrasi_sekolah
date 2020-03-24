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
                <h3><i class="nav-icon fas fa-users my-0 btn-sm-1"></i> Data Anggota Rombongan Belajar</h3>
                <hr>
            </div>
        </div>
        <div>
            <div class="col">
                <a class="btn btn-danger btn-sm my-1 mr-sm-1" href="/rombel/index" role="button"><i class="fas fa-undo"></i> Kembali</a>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>NISN</th>
                                <th>No. Induk</th>
                                <th>Rombel</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Pendaftaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;?>
                            @foreach($data_anggota as $anggota)
                            <?php $no++ ;?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$anggota->pesdik->nama}}</td>
                                <td>{{$anggota->pesdik->jenis_kelamin}}</td>
                                <td>{{$anggota->pesdik->nisn}}</td>
                                <td>{{$anggota->pesdik->induk}}</td>
                                <td>{{$anggota->pesdik->rombel->nama_rombel}}</td>
                                <td>{{$anggota->pesdik->tempat_lahir}}</td>
                                <td>{{$anggota->pesdik->tanggal_lahir}}</td>
                                <td>{{$anggota->pesdik->jenis_pendaftaran}}</td>
                                <td>{{$anggota->pesdik->status}}</td>
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
