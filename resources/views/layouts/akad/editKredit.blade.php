@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Kredit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Kredit</a></li>
            <li class="breadcrumb-item active">Edit Kredit</li>
          </ol>
        </div><!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Kredit</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/akad/kredit/update/{{$kredit->id_kredit}}" method="POST">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="id_kredit">ID Kredit</label>
                                    <input type="id" class="form-control col-md-4" name="id_kredit" value="KDT{{$kredit->id_kredit}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$kredit->no_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="name" class="form-control" name="name" value="{{$kredit->name}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="tglhutang">Tanggal</label>
                                  <input type="date" class="form-control col-sm-4" name="tglhutang" value="{{$kredit->tgl}}">
                                    @if ($errors->has('tglhutang'))
                                    <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" value="{{$kredit->nama_barang}}">
                                    @if ($errors->has('nama_barang'))
                                    <span class="text-danger">{{ $errors->first('nama_barang') }}</span>
                                    @endif
                                    <p>
                                    <div class="row">
                                        <div class=" col-3">
                                            <label for="jumlah">Jumlah</label>
                                        </div>
                                        <div>
                                            <label for="harga">Harga</label>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control col-md-2" id="jumlah" name="jumlah" value="{{$kredit->jumlah}}">
                                        <div class="input-group-append">
                                          <span class="input-group-text"><i class="fas fa-times"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="harga" name="harga" value="{{$kredit->harga}}">
                                        {{-- <span class="input-group-text text-bold">=</span> --}}
                                        {{-- <input type="text" class="form-control" id="totalharga" name="totalharga" value="@currency(($kredit->jumlah)*($kredit->harga))" readonly> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">Max Angsuran</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="maximal_angsuran" value="{{$kredit->maximal_angsuran}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">bulan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="">Lama Angsuran</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="lama_angsuran" value="{{$kredit->lama_angsuran}}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">bulan</span>
                                            </div>
                                        </div>
                                        @if ($errors->has('lama_angsuran'))
                                            <span class="text-danger">{{ $errors->first('lama_angsuran') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jatuh_tempo">Jatuh Tempo</label>
                                    <input type="date" class="form-control col-sm-4" name="jatuh_tempo" value="{{$kredit->jatuh_tempo}}">
                                    @if ($errors->has('jatuh_tempo'))
                                    <span class="text-danger">{{ $errors->first('jatuh_tempo') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="sistem_angsur">Sisa Kredit</label>
                                    <input type="text" class="form-control col-sm-4" name="sisa_kredit" value="{{$kredit->sisa_kredit}}">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">{{$kredit->keterangan}}</textarea>
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