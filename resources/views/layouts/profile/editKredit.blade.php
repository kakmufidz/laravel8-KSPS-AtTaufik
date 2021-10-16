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
                        <form action="/anggota/profile/updatekredit/{{$kredit->id_kredit}}" method="POST">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="id_kredit">ID Kredit</label>
                                    <input type="id" class="form-control col-md-4" name="id_kredit" value="K100{{$kredit->id_kredit}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$kredit->no_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="name" class="form-control" name="name" value="{{$kredits->name}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="tglhutang" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{$kredit->tgl->format('d/m/Y')}}"/>
                                          @if ($errors->has('tglhutang'))
                                          <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
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
                                  <label>Jatuh Tempo</label>
                                    <div class="input-group date" id="reservationdatejatuhtempo" data-target-input="nearest">
                                        <input name="jatuh_tempo" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatejatuhtempo" placeholder="Jatuh Tempo" value="{{$kredit->jatuh_tempo->format('d/m/Y')}}"/>
                                          @if ($errors->has('jatuh_tempo'))
                                          <span class="text-danger">{{ $errors->first('jatuh_tempo') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdatejatuhtempo" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
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
@section('script')
<script type="text/javascript">
//Date range picker
$('#reservationdate').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#reservationdatejatuhtempo').datetimepicker({
    format: 'DD/MM/YYYY'
});
</script>
@endsection