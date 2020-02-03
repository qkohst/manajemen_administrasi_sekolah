@extends('layouts.master')
@section('content')
    <section class="content card" style="padding: 10px 0px 10px 10px ">
        <div class="box">
            @if(session('sukses'))
            <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Disposisi</h3>
                    <hr />
                </div>
            </div>
            <div>
                <div class="col">
                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="{{ route('disposisi.create', $smasuk) }}" role="button"><i class="fas fa-plus"></i> Tambah Data</a>
                    <br><br>
                </div>
            </div>
            <div class="row">
                    <div class="col">
                            <table class="table table-hover table-head-fixed" id='tabelKlasifikasi'>
                                <thead>
                                    <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Tujuan</th>
                                    <th>Isi Disposisi</th>
                                    <th>Sifat</th>
                                    <th>Batas Waktu</th>
                                    <th>Catatan</th>
                                    <th>User</th>
                                    <th>ID Surat</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $no = 0;?>
                                        @foreach($disp as $disposisi)
                                        <?php $no++ ;?>
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$disposisi->tujuan}}</td>
                                            <td>{{$disposisi->isi}}</td>
                                            <td>{{$disposisi->sifat}}</td>
                                            <td>{{$disposisi->batas_waktu}}</td>
                                            <td>{{$disposisi->catatan}}</td>
                                            <td>{{$disposisi->users_id}}</td>
                                            <td>{{$disposisi->smasuk_id}}</td>
                                            <td>
                                                <form action="{{ route('disposisi.destroy', [$disposisi->smasuk_id, $disposisi->id]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                <a href="{{ route('disposisi.edit', [$disposisi->smasuk_id, $disposisi->id]) }}" class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                                <a href="#" class="btn btn-primary btn-sm my-1 mr-sm-1 btn-block"><i class="nav-icon fas fa-print"></i> Cetak</a>
                                                <button type="submit" class="btn btn-danger btn-sm my-1 mr-sm-1 btn-block" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i> Hapus</button>
                                                </form>
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

