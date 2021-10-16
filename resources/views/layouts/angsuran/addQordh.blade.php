@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Angsuran</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">hutang</a></li>
            <li class="breadcrumb-item active">Tambah Angsuran</li>
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
                        <h3 class="card-title">Data Angsuran Baru</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/angsuran/qordh/tambah" method="post">
                            <!--card-body -->
                            @csrf
                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$detailAnggota->id_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="name" class="form-control col-md-6" id="name" value="{{$detailAnggota->name}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="tglangsur" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tglangsur')}}"/>
                                          @if ($errors->has('tglangsur'))
                                          <span class="text-danger">{{ $errors->first('tglangsur') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label>Data hutang</label>
                                  @if ($detailQordh == null)
                                    <div class="alert alert-danger">
                                      Data kredit tidak ditemukan
                                    </div>
                                  @else
                                  <div class="input-group mb-3">
                                    <input class="form-control bg-danger col-sm-2" name="id_qordh" value="{{$detailQordh->id_qordh}}" readonly>
                                    <input class="form-control bg-danger" name="data_qordh" value="{{$detailAnggota->name}} | {{$detailQordh->tgl}} | Rp. @currency($detailQordh->jumlah)" readonly>
                                  </div>
                                  @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control col-md-6" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
</script>
@endsection