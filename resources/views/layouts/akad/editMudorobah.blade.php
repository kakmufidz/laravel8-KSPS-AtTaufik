@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Mudorobah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Mudorobah</a></li>
            <li class="breadcrumb-item active">Edit Mudorobah</li>
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
                        <h3 class="card-title">Edit Data Mudorobah</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="/akad/mudorobah/update/{{$mudorobah->id_mudorobah}}" method="POST">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="id_mudorobah">ID Mudorobah</label>
                                    <input type="id" class="form-control col-md-4" name="id_mudorobah" value="KDT{{$mudorobah->id_mudorobah}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$mudorobah->no_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="name" class="form-control" name="name" value="{{$mudorobah->name}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="tglhutang">Tanggal</label>
                                  <input type="date" class="form-control col-sm-4" name="tglhutang" value="{{$mudorobah->tgl}}">
                                    @if ($errors->has('tglhutang'))
                                    <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jenis_usaha">Jenis Usaha</label>
                                    <input type="text" class="form-control" name="jenis_usaha" value="{{$mudorobah->jenis_usaha}}">
                                    @if ($errors->has('jenis_usaha'))
                                    <span class="text-danger">{{ $errors->first('jenis_usaha') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" value="{{$mudorobah->jumlah}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="bagi_hasil">Bagi Hasil</label><br>
                                    <input type="bagi_hasil" class="form-control" name="bagi_hasil" value="{{$mudorobah->bagi_hasil}}">
                                    @if ($errors->has('bagi_hasil'))
                                    <span class="text-danger">{{ $errors->first('bagi_hasil') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="berakhir">Berakhir Sampai</label>
                                    <input type="text" class="form-control" name="berakhir" value="{{$mudorobah->berakhir}}">
                                    @if ($errors->has('berakhir'))
                                    <span class="text-danger">{{ $errors->first('berakhir') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="penanggungjawab">Penanggungjawab</label>
                                    <input type="text" class="form-control" name="penanggungjawab" value="{{$mudorobah->penanggungjawab}}">
                                    @if ($errors->has('penanggungjawab'))
                                    <span class="text-danger">{{ $errors->first('penanggungjawab') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="saksi">Saksi</label>
                                    <input type="text" class="form-control" name="saksi" value="{{$mudorobah->saksi}}">
                                    @if ($errors->has('saksi'))
                                    <span class="text-danger">{{ $errors->first('saksi') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">{{$mudorobah->keterangan}}</textarea>
                                </div>
                              </div>
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                              </div>    
                            </div>
                            <!-- /.card-body -->
                        </form>
                </div>
                <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
          <!-- /.content -->
          <!-- jQuery -->
    <!-- date-range-picker -->
</div>
  <!-- /.content-header -->
@endsection