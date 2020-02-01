@extends('layouts.master')
@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px ">
        <div class="box">
                @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                        {{session('sukses')}}
                </div>
                @endif
            <div class="row">
                <div class="col">
                <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Agenda Surat Masuk</h3>
                <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label for="tgl1"><i class="nav-icon fas fa-calendar-alt my-1 btn-sm-1"></i> Dari Tanggal</label>
                </div>
                <div class="col-2">
                    <label for="tgl2"> <i class="nav-icon fas fa-calendar-alt my-1 btn-sm-1"></i> Sampai Tanggal</label>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <input name="tgl_awal" type="date" class="form-control bg-light my-1" id="tgl1">
                </div>
                <div class="col-2">
                    <input name="tgl_akhir" type="date" class="form-control bg-light my-1" id="tgl2">
                </div>
                <div class="col-2">
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="#" role="button"><i class="far fa-eye"></i> Tampilkan</a>
                </nav>
                </div>
                <div class="col-6 right">
                <span style="float: right">
                    <nav class="navbar">
                        <div class="col">
                            <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="/suratmasuk/agendamasukcetak_pdf" role="button"><i class="fas fa-file-download"></i> Download Pdf</a>
                        </div>
                    </nav>
                </span>
                </div>
                <div class="row table-responsive">
                    <div class="col-12">
                        <table class="table table-head-fixed" id='tabelAgendaMasuk'>
                            <thead>
                                <tr class="bg-light">
                                <th>No.</th >
                                <th>Isi Ringkas</th>
                                <th>Asal Surat</th>
                                <th>Kode</th>
                                <th>No. Surat</th>
                                <th>Tgl. Surat</th>
                                <th>Tgl. Diterima</th>
                                <th>Penerima</th>
                                <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;?>
                                @foreach($data_suratmasuk as $suratmasuk)
                                <?php $no++ ;?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$suratmasuk->isi}}</td>
                                    <td>{{$suratmasuk->asal_surat}}</td>
                                    <td>{{$suratmasuk->kode}}</td>
                                    <td>{{$suratmasuk->no_surat}}</td>
                                    <td>{{$suratmasuk->tgl_surat}}</td>
                                    <td>{{$suratmasuk->tgl_terima}}</td>
                                    <td>{{$suratmasuk->users->name}}</td>
                                    <td>{{$suratmasuk->keterangan}}</td>
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

