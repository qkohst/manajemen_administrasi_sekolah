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
                <a class="btn btn-success btn-sm my-1 mr-sm-1" href="/rombel/{{$rombel}}/tambahAnggota" role="button"><i class="fas fa-plus"></i> Tambah Anggota</a>
                <br>
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
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data_anggota as $anggota)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$anggota->nama}}</td>
                                <td>{{$anggota->jenis_kelamin}}</td>
                                <td>{{$anggota->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>Laki-Laki</td>
                                <td colspan="2">: {{$jumlah_anggota_L}} Siswa</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Perempuan</td>
                                <td colspan="2">: {{$jumlah_anggota_P}} Siswi</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><b>Jumlah</b></td>
                                <td colspan="2"><b>: {{$jumlah_anggota_L+$jumlah_anggota_P}} Anggota</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection