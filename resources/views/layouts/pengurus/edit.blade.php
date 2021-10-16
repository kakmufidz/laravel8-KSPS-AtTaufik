@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Pengurus</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Pengurus</a></li>
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
                        <h3 class="card-title">Edit Data Pengurus</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/koperasi/pengurus/update/{{$pengurus->id}}" method="POST">
                        <!--card-body -->
                        @csrf
                        <div class="card-body col-sm-6">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="name" class="form-control" name="name" placeholder="Nama Lengkap" value="{{$pengurus->name}}">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="jabatan" class="form-control" name="jabatan" placeholder="Tempat Lahir" value="{{$pengurus->jabatan}}">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select class="form-control" name="jabatan" onchange="apa(this)" value="{{$pengurus->jabatan}}">
                                <option>Ketua Umum</option>
                                <option>Sekretaris</option>
                                <option>Bendahara</option>
                                <option>Lainnya</option>
                            </select>
                            <input type="text" style="visibility:hidden" class="form-control mt-3" name="jabatanlain" id="jabatan">
                            @if ($errors->has('jabatan'))
                            <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tmlahir">Tempat Lahir</label>
                            <input type="tmlahir" class="form-control" name="tmlahir" placeholder="Tempat Lahir" value="{{$pengurus->tmlahir}}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input name="tglahir" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{$pengurus->tglahir->format('d/m/Y')}}"/>
                                    @if ($errors->has('tglahir'))
                                    <span class="text-danger">{{ $errors->first('tglahir') }}</span>
                                    @endif
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" class="form-control" name="alamat" placeholder="Alamat" value="{{$pengurus->alamat}}">
                                @if ($errors->has('alamat'))
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="hp">No HP</label>
                            <input type="text" id="hp" class="form-control" name="hp" placeholder="No. HP" value="{{$pengurus->hp}}">
                                @if ($errors->has('hp'))
                                    <span class="text-danger">{{ $errors->first('hp') }}</span>
                                @endif
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer col-md-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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
@section('script')
<script>
    function hide()
    {
        var a=document.getElementById('jabatan');
        a.style.visibility='hidden';
    }
    function tampil()
    {
        var a=document.getElementById('jabatan');
        a.style.visibility='visible';
    }
    function apa(select) {
        if(select.value=='Lainnya'){
            tampil();
        }else{
            hide();
        }
    }
</script>
<script type="text/javascript">
    $('#reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
</script>
@endsection