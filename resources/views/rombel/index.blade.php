@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
    <div class="box">
        @if(session('sukses'))
        <div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
            <h5><i class="fas fa-check"></i> Sukses :</h5>
            {{session('sukses')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('warning'))
        <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
            <h5><i class="fas fa-info"></i> Informasi :</h5>
            {{session('warning')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if ($errors->any())
        <div class="callout callout-danger alert alert-danger alert-dismissible fade show">
            <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
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
                <h4><i class="nav-icon fas fa-users my-0 btn-sm-1"></i> Data Rombongan Belajar</h3>
                <hr>
            </div>
        </div>
        <div>
            <div class="col">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahRombel"><i class="fas fa-plus"></i>
                    Tambah Data
                </button>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Tahun Pelajaran</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>Nama Rombel</th>
                                <th>Wali Kelas</th>
                                <th>Jumlah Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data_rombel as $rombel)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$rombel->tapel->tahun}}</td>
                                <td>{{$rombel->tapel->semester}}</td>
                                <td>{{$rombel->kelas}}</td>
                                <td>{{$rombel->nama_rombel}}</td>
                                <td>{{$rombel->guru->nama}}</td>
                                <td>
                                    {{DB::table('pesdik')->where('rombel_id', $rombel->id)->count()}} Siswa
                                </td>
                                <td>
                                    <a href="/rombel/{{$rombel->id}}/anggota" class="btn btn-success btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-eye"></i> Lihat Anggota</a>
                                    <a href="/rombel/{{$rombel->id}}/edit" class="btn btn-primary btn-sm my-1 mr-sm-1"><i class="nav-icon fas fa-pencil-alt"></i> Edit</a>
                                    @if (auth()->user()->role == 'admin')
                                    <a href="/rombel/{{$rombel->id}}/delete" class="btn btn-danger btn-sm my-1 mr-sm-1" onclick="return confirm('Hapus Data ?')"><i class="nav-icon fas fa-trash"></i>
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
            <div class="modal fade" id="tambahRombel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-users my-1 btn-sm-1"></i> Tambah Data Rombongan Belajar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/rombel/tambah" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                    <label for="tapel_id">Tahun Pelajaran</label>
                                    <select name="tapel_id" class="form-control my-1 mr-sm-2 bg-light" id="tapel_id" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                        <option value="">-- Pilih Tahun Pelajaran --</option>
                                        @foreach($data_tapel as $tapel)
                                        <option value="{{$tapel->id}}">{{$tapel->tahun}} ({{$tapel->semester}})
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="kelas">Kelas</label>
                                    <select name="kelas" class="form-control my-1 mr-sm-2 bg-light" id="kelas" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                    <label for="nama_rombel">Nama Rombel</label>
                                    <input value="{{old('nama_rombel')}}" name="nama_rombel" type="text" class="form-control bg-light" id="nama_rombel" placeholder="Nama Rombel" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                    <label for="guru_id">Wali Kelas</label>
                                    <select name="guru_id" class="form-control my-1 mr-sm-2 bg-light" id="guru_id" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                        <option value="">-- Pilih Wali Kelas--</option>
                                        @foreach($data_guru as $guru)
                                        <option value="{{$guru->id}}">{{$guru->nama}}
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