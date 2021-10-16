@extends('layouts.master')
@section('konten')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Pengeluaran Koperasi</h1>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Pengeluaran Baru</h3>
                        </div>
                        @if (session('statusdg'))
                        <div class="alert alert-danger">
                        {{session('statusdg')}}
                        </div>
                        @endif
                        <form action="/pengeluaran/tambah" method="post">
                            @csrf
                            <!--card-body -->
                            <div class="card-body col-sm-6">
                                <div class="form-group">
                                  <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="tglkeluar" type="text" class="form-control datetimepicker-input col-sm-4" data-target="#reservationdate" placeholder="Tanggal" value="{{old('tglkeluar')}}"/>
                                          @if ($errors->has('tglkeluar'))
                                          <span class="text-danger">{{ $errors->first('tglkeluar') }}</span>
                                          @endif
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sumber_dana">Sumber Dana</label>
                                    <select class="form-control bg-secondary" name="sumber_dana" value="{{old('sumber_dana')}}">
                                      <option>Dana Aman</option>
                                      <option>Dana Cadangan</option>
                                      <option>Dana Sosial</option>
                                      <option>SHU Pengurus</option>
                                      <option>SHU Anggota</option>
                                    </select>
                                </div>
                                  @if ($errors->has('sumber_dana'))
                                  <span class="text-danger">{{ $errors->first('sumber_dana') }}</span>
                                  @endif
                                <div class="form-group">
                                    <label for="pengeluaran">Pengeluaran</label>
                                    <input type="text" class="form-control" name="pengeluaran" placeholder="pengeluaran" value="{{old('pengeluaran')}}">
                                    @if ($errors->has('pengeluaran'))
                                    <span class="text-danger">{{ $errors->first('pengeluaran') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}">
                                    @if ($errors->has('jumlah'))
                                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga" placeholder="0">
                                    @if ($errors->has('harga'))
                                    <span class="text-danger">{{ $errors->first('harga') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="total_harga">Total Harga</label>
                                    <input type="text" class="form-control" id="total_harga" name="total_harga" value="0" readonly>
                                    @if ($errors->has('total_harga'))
                                    <span class="text-danger">{{ $errors->first('total_harga') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" style="margin-top: 0px; margin-bottom: 0px; height: 131px;">Oke...</textarea>
                                </div>
                            </div>
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
    $(document).ready(function() {
        $("#jumlah, #harga").keyup(function() {
            var jumlah  = $("#jumlah").val();
            var harga = $("#harga").val();

            var total_harga = parseFloat(jumlah) * parseFloat(harga);
            $("#total_harga").val(total_harga);
        });
    });
</script>
@endsection