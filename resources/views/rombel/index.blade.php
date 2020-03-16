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
                <h3><i class="nav-icon fas fa-users my-0 btn-sm-1"></i> Data Rombongan Belajar</h3>
                <hr>
            </div>
        </div>
        <div>
                <div class="col">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#tambahRombel"><i class="fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
                <br>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Kelas</th>
                                <th>Nama Rombel</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;?>
                            @foreach($data_rombel as $rombel)
                            <?php $no++ ;?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$rombel->kelas}}</td>
                                <td>{{$rombel->nama_rombel}}</td>
                                <td>{{$rombel->wali_kelas}}</td>
                                <td>
                                <a href="/rombel/{{$rombel->id}}/anggota"
                                    class="btn btn-success btn-sm my-1 mr-sm-1"><i
                                        class="nav-icon fas fa-users"></i> Anggota Rombel</a>
                                <a href="/rombel/{{$rombel->id}}/edit"
                                    class="btn btn-primary btn-sm my-1 mr-sm-1"><i
                                        class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                @if (auth()->user()->role == 'admin')
                                <a href="/rombel/{{$rombel->id}}/delete"
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
            <!-- Modal Tambah -->
        <div class="modal fade" id="tambahRombel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i
                                class="nav-icon fas fa-users my-1 btn-sm-1"></i> Tambah Data Rombongan Belajar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/rombel/tambah" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" class="custom-select my-1 mr-sm-2 bg-light" id="kelas"required>
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                    <label for="nama_rombel">Nama Rombel</label>
                                    <input value="{{old('nama_rombel')}}" name="nama_rombel" type="text" class="form-control bg-light"
                                        id="nama_rombel" placeholder="Nama Rombel" required>
                                    <label for="wali_kelas">Wali Kelas</label>
                                    <select name="wali_kelas" class="custom-select my-1 mr-sm-2 bg-light" id="wali_kelas"required>
                                        <option value="">-- Pilih Wali Kelas--</option>
                                        @foreach($data_guru as $guru)
                                        <option value="{{$guru->nama}}">{{$guru->nama}}
                                        </option>
                                        @endforeach
                                    </select>
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
