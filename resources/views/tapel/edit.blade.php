@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
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
        <form action="/tapel/{{$tapel->id}}/update" method="POST">
            <h4><i class="nav-icon fas fa-calendar-alt my-1 btn-sm-1"></i> Edit Data Tahun Pelajaran</h4>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-md">
                    <label for="tahun">Tahun Pelajaran</label>
                    <input name="tahun" type="text" class="form-control bg-light" id="tahun" placeholder="Contoh : (2019/2020)" value="{{$tapel->tahun}}" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control bg-light" required oninvalid="this.setCustomValidity('Isian ini tidak boleh kosong !')" oninput="setCustomValidity('')">
                        <option value="Semester Ganjil" @if ($tapel->semester == 'Semester Ganjil') selected @endif>Semester Ganjil</option>
                        <option value="Semester Genap" @if ($tapel->semester == 'Semester Genap') selected @endif>Semester Genap</option>
                    </select>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/tapel/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection