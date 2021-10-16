@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Hutang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Hutang</a></li>
            <li class="breadcrumb-item active">Edit Hutang</li>
          </ol>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Hutang</h3>
                        </div>
                        <form action="/akad/qordh/update/{{$qordh->id_qordh}}" method="POST">
                            @csrf
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="id_qordh">ID Hutang</label>
                                    <input type="id" class="form-control col-md-4" name="id_qordh" value="QRD{{$qordh->id_qordh}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$qordh->no_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="name" class="form-control" name="name" value="{{$qordh->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tglhutang">Tanggal</label>
                                    <input type="date" class="form-control col-sm-4" name="tglhutang" value="{{$qordh->tgl}}">
                                    @if ($errors->has('tglhutang'))
                                    <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" value="{{$qordh->jumlah}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="lama_angsuran">Target Jumlah Angsuran</label>
                                    <div class="input-group ">
                                        <input type="text" class="form-control" name="lama_angsuran" value="{{$qordh->lama_angsuran}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kali</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('lama_angsuran'))
                                    <span class="text-danger">{{ $errors->first('lama_angsuran') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jatuh_tempo">Jatuh Tempo</label>
                                    <input type="date" class="form-control" name="jatuh_tempo" value="{{$qordh->jatuh_tempo}}">
                                    @if ($errors->has('jatuh_tempo'))
                                    <span class="text-danger">{{ $errors->first('jatuh_tempo') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="sistem_angsur">Sisa Kredit</label>
                                    <input type="text" class="form-control col-sm-4" name="sisa_qordh" value="{{$qordh->sisa_qordh}}">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">{{$qordh->keterangan}}</textarea>
                                </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection