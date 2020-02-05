@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-layer-group my-1 btn-sm-1"></i> Klasifikasi Surat</h3>
                <hr>
            </div>
        </div>
        <div>
            <div class="col">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                    data-target="#tambahklasifikasi"><i class="fas fa-plus"></i>
                    Tambah Data
                </button>
            </div>
            <br>
        </div>
        <div class="row table-responsive">
            <div class="col-12">
                <table class="table table-hover table-head-fixed" id='tabelKlasifikasi'>
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Uraian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;?>
                        @foreach($data_klasifikasi as $klasifikasi)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$klasifikasi->nama}}</td>
                            <td>{{$klasifikasi->kode}}</td>
                            <td>{{$klasifikasi->uraian}}</td>
                            <td>
                                <a href="/klasifikasi/{{$klasifikasi->id}}/edit"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1"><i
                                        class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                @if (auth()->user()->role == 'admin')
                                <a href="/klasifikasi/{{$klasifikasi->id}}/delete"
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

        <!-- Modal Import -->
        <div class="modal fade" id="importKlasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i
                                class="nav-icon fas fa-layer-group my-1 btn-sm-1"></i> Import File Klasifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- {!! Form::open(['route'=>'klasifikasi/import','class'=>'form-horizontal','enctype'=>'multipart/form-data']) !!}

                        {!! Form::file('data_klasifikasi.xls') !!} --}}
                        <div class="card-body">
                            <form action="{{ url('klasifikasi.import') }}" method="POST" name="importform"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="data_klasifikasi.xls" class="form-control">
                                <br>
                                {{-- <button class="btn btn-success">Import File</button> --}}
                                {{-- </form> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-sm btn-primary" value="Import">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahklasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i
                                class="nav-icon fas fa-layer-group my-1 btn-sm-1"></i> Tambah Data Klasifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/klasifikasi/tambah" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col">
                                    <label for="nama">Nama</label>
                                    <input name="nama" type="text" class="form-control bg-light" id="nama"
                                        placeholder="Nama Klasifikasi" required>
                                    <label for="kode">Kode</label>
                                    <input name="kode" type="text" class="form-control bg-light" id="kode"
                                        placeholder="Kode Klasifikasi" required>
                                    <label for="uraian">Uraian</label>
                                    <textarea name="uraian" class="form-control bg-light" id="uraian" rows="3"
                                        placeholder="Uraian Klasifikasi" required></textarea>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i>
                                SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
