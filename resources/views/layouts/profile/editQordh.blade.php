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
                        <form action="/anggota/profile/updateqordh/{{$qordh->id_qordh}}" method="POST">
                            @csrf
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                    <label for="id_qordh">ID Hutang</label>
                                    <input type="id" class="form-control col-md-4" name="id_qordh" value="H100{{$qordh->id_qordh}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_anggota">No. Anggota</label>
                                    <input type="id" class="form-control col-md-4" name="id_anggota" value="{{$qordh->no_anggota}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="name" class="form-control" name="name" value="{{$qordhs->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="tglhutang" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{$qordh->tgl->format('d/m/Y')}}"/>
                                            @if ($errors->has('tglhutang'))
                                            <span class="text-danger">{{ $errors->first('tglhutang') }}</span>
                                            @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
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
                                  <label>Jatuh Tempo</label>
                                    <div class="input-group date" id="reservationdatejatuhtempo" data-target-input="nearest">
                                        <input name="jatuh_tempo" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdatejatuhtempo" placeholder="Jatuh Tempo" value="{{$qordh->jatuh_tempo->format('d/m/Y')}}"/>
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