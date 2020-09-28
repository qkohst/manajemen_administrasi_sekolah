@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
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
        <h4><i class="nav-icon fas fa-child my-1 btn-sm-1"></i> Registrasi Peserta Didik</h4>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="/adminLTE/img/user.png" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center"><b>{{$pesdik->nama}}</b></h3>
                                <p class="text-muted text-center">{{$pesdik->rombel->nama_rombel}} {{$pesdik->rombel->tapel->semester}}</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Tempat, Tenggal lahir</b>
                                        <a class="float-right">{{$pesdik->tempat_lahir}}, {{$pesdik->tanggal_lahir}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Kelamin</b> <a class="float-right">{{$pesdik->jenis_kelamin}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>NISN/Induk</b>
                                        <a class="float-right">{{$pesdik->induk}}</a>
                                        <a class="float-right">/</a>
                                        <a class="float-right">{{$pesdik->nisn}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Pendaftaran</b> <a class="float-right">{{$pesdik->jenis_pendaftaran}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Masuk</b> <a class="float-right">{{$pesdik->tanggal_masuk}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active btn-sm" href="#keluar" data-toggle="tab"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                                    @if ($pesdik->rombel->kelas == '9' && $pesdik->rombel->tapel->semester == 'Semester Genap')
                                    <li class="nav-item"><a class="nav-link btn-sm" href="#lulus" data-toggle="tab"><i class="fas fa-user-graduate"></i> Lulus</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="keluar">
                                        <form action="/pesdik/{{$pesdik->id}}/keluar" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group row">
                                                <label for="keluar_karena" class="col-sm-3 col-form-label">Keluar Karena</label>
                                                <div class="col-sm-4">
                                                    <select name="keluar_karena" class="form-control my-1 mr-sm-1 bg-light" id="keluar_karena" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                        <option value="">-- Pilih Jenis Keluar --</option>
                                                        <option value="Mutasi">Mutasi</option>
                                                        <option value="Dikeluarkan">Dikeluarkan</option>
                                                        <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                                                        <option value="Putus Sekolah">Putus Sekolah</option>
                                                        <option value="Wafat">Wafat</option>
                                                        <option value="Lainnya">Lainnya....</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar Sekolah</label>
                                                <div class="col-sm-4">
                                                    <input value="{{old('tanggal_keluar')}}" name="tanggal_keluar" type="date" class="form-control bg-light" id="tanggal_keluar" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="alasan_keluar" class="col-sm-3 col-form-label">Alasan Keluar</label>
                                                <div class="col-sm-9">
                                                    <textarea name="alasan_keluar" class="form-control bg-light" id="alasan_keluar" rows="3" placeholder="Alasan Keluar" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('alasan')}}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <hr>
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                                            <a class="btn btn-danger btn-sm" href="/pesdik/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="lulus">
                                        <form action="/pesdik/{{$pesdik->id}}/alumni" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group row">
                                                <label for="tanggal_lulus" class="col-sm-3 col-form-label">Tanggal Lulus Sekolah</label>
                                                <div class="col-sm-4">
                                                    <input value="{{old('tanggal_lulus')}}" name="tanggal_lulus" type="date" class="form-control bg-light" id="tanggal_lulus" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="melanjutkan_ke" class="col-sm-3 col-form-label">Melanjutkan Ke</label>
                                                <div class="col-sm-4">
                                                    <select name="melanjutkan_ke" class="form-control my-1 mr-sm-1 bg-light" id="melanjutkan_ke" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                                                        <option value="">-- Pilih Data --</option>
                                                        <option value="SMA/SMK">SMA/SMK</option>
                                                        <option value="Mondok">Mondok</option>
                                                        <option value="SMA/SMK + Mondok">SMA/SMK + Mondok</option>
                                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                        <option value="Lainnya">Lainnya....</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                                <div class="col-sm-9">
                                                    <textarea name="keterangan" class="form-control bg-light" id="keterangan" rows="3" placeholder="Keterangan" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">{{old('alasan')}}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <hr>
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                                            <a class="btn btn-danger btn-sm" href="/pesdik/index" role="button"><i class="fas fa-undo"></i> BATAL</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
    </div>
</section>
@endsection