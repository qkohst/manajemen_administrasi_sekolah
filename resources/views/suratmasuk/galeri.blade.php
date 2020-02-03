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
                    <h3><i class="nav-icon fas fa-images my-1 btn-sm-1"></i> Galeri Surat Masuk</h3>
                    <hr />
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
            </div>
            <div class="row">
                <div class="card-body">
                    <div>
                      <div class="filter-container p-0 row">
                        <?php $no = 0;?>
                        @foreach($data_suratmasuk as $suratmasuk)
                        <?php $no++ ;?>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box">
                                  <div class="inner">
                                        <a href="{{URL::to('/')}}/datasuratmasuk/{{$suratmasuk->filemasuk}}" data-toggle="lightbox" data-title="Perbesar Gambar">
                                            <center>
                                                <img src="{{URL::to('/')}}/datasuratmasuk/{{$suratmasuk->filemasuk}}" width="200" alt="File .doc, .docx, atau .pdf tidak dapat ditampilkan, Silahkan klik Lihat Detail File">
                                            </center>
                                        </a>
                                  </div>
                                  <a href="/suratmasuk/{{$suratmasuk->id}}/tampil" class="small-box-footer bg-success">Lihat Detail File <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                      </div>
                    </div>
                    <small class="text-danger">
                    <b>Catatan : </b>File .doc, .docx, atau .pdf tidak dapat ditampilkan disini silahkan klik <b>Lihat Detail File</b> !!!
                    </small>
                </div>
                </div>
      </div>
    </div>
 @endsection

