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
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Surat Masuk</h3>
                <hr />
            </div>
        </div>
        <div>
            <div class="col">
                <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="create" role="button"><i class="fas fa-plus"></i>
                    Tambah Data</a>
                <br>
            </div>
        </div>
        <div class="row table-responsive">
            <div class="col">
                <table class="table table-hover table-head-fixed" id='tabelSuratmasuk'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Isi Ringkas</th>
                            <th>File</th>
                            <th>Asal Surat</th>
                            <th>Kode</th>
                            <th>No. Surat</th>
                            <th>Tgl. Surat</th>
                            <th>Tgl. Diterima</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;?>
                        @foreach($data_suratmasuk as $suratmasuk)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$suratmasuk->isi}}</td>
                            <td><a href="/suratmasuk/{{$suratmasuk->id}}/tampil">{{$suratmasuk->filemasuk}}</a></td>
                            <td>{{$suratmasuk->asal_surat}}</td>
                            <td>{{$suratmasuk->kode}}</td>
                            <td>{{$suratmasuk->no_surat}}</td>
                            <td>{{$suratmasuk->tgl_surat}}</td>
                            <td>{{$suratmasuk->tgl_terima}}</td>
                            <td>{{$suratmasuk->keterangan}}</td>
                            <td>
                                <a href="/suratmasuk/{{$suratmasuk->id}}/edit"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i
                                        class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                <a href="{{ route('disposisi.index', $suratmasuk->id) }}"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i
                                        class="fas fa-file-alt"></i> Disposisi</a>
                                @if (auth()->user()->role == 'admin')
                                <a href="/suratmasuk/{{$suratmasuk->id}}/delete"
                                    class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block"
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
</section>
@endsection
