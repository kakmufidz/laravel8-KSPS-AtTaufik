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
                        <form action="/anggota/profile/updatemudorobah/{{$mudorobah->id_mudorobah}}" method="POST">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="id_mudorobah">ID Mudorobah</label>
                                    <input type="id" class="form-control col-md-4" name="id_mudorobah" value="M100{{$mudorobah->id_mudorobah}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$mudorobah->no_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="name" class="form-control" name="name" value="{{$mudorobahs->name}}" readonly>
                                </div>
                                <div class="form-group">
                                  <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="tglhutang" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{$mudorobah->tgl->format('d/m/Y')}}"/>
                                          @if ($errors->has('tglhutang'))
                                          <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
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
                                    <label>Penanggungjawab</label>
                                    <select name="penanggungjawab" class="select2bs4 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option>{{$mudorobah->penanggungjawab}}</option>
                                        @forelse ($penguruses as $pengurus)
                                            <option>
                                                @if ($pengurus->name == $mudorobahs->penanggungjawab)
                                                @else
                                                    {{$pengurus->name}}
                                                @endif
                                            </option>
                                        @empty
                                            <option class="bg-danger">Data pengurus belum tersedia</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('penanggungjawab'))
                                    <span class="text-danger">{{ $errors->first('penanggungjawab') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Saksi</label>
                                    <select name="saksi" class="select2bs4 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option>{{$mudorobah->saksi}}</option>
                                        @forelse ($anggotas as $anggota)
                                            <option>
                                                @if ($anggota->name == substr($mudorobahs->saksi,5))
                                                @elseif ($anggota->name == $mudorobahs->name)
                                                @else
                                                    {{$anggota->id_anggota}} {{$anggota->name}}
                                                @endif
                                            </option>
                                        @empty
                                            <option class="bg-danger">Data anggota belum tersedia</option>
                                        @endforelse
                                    </select>
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
</div>
  <!-- /.content-header -->
@endsection
@section('script')
<script type="text/javascript">
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
</script>
@endsection